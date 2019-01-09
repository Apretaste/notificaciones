<?php

/**
 * Service NOTIFICACIONES
 * @author salvipascual
 */
class Service
{
	/**
	 * Get the list of notifications
	 *
	 * @param Request
	 * @param Response
	 * */
	public function _main(Request $request, Response $response)
	{
		// get the origins of the notifications if passed
		$origins = [];
		$data = $request->input->data;
		$wwwroot = \Phalcon\DI\FactoryDefault::getDefault()->get('path')['root'];
		
		if(isset($data->services)) foreach ($data->services as $o) $origins[] = $o;

		// get notifications
		$notifications = Utils::getNotifications($request->person->id, 20, $origins);
		$images = [];
		foreach($notifications as &$notification){
			$origin = $notification->origin;
			$origin = strtolower($origin);

			$notification->image = "$wwwroot/services/$origin/$origin.png";
			if(!file_exists($notification->image)) $notification->image = "$wwwroot/public/images/noicon.png";
			if(!in_array($notification->image, $images)) $images[] = $notification->image;
			$notification->image = basename($notification->image);
			
			$notification->origin = substr_replace($origin,strtoupper(substr($origin,0,1)),0,1);
		}
		$content = new stdClass();
		$content->notifications = $notifications;
		$response->setTemplate('basic.ejs', $content, $images);
	}
}
