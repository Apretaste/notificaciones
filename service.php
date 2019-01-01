<?php

/**
 * Service NOTIFICACIONES
 * @author salvipascual
 */
class Notificaciones extends Service
{
	/**
	 * Get the list of notifications
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request)
	{
		// get the origins of the notifications if passed
		$origins = [];

		$servicesDir = \Phalcon\DI\FactoryDefault::getDefault()->get('path')['root'].'/services/';
		if($request->query) foreach (explode(" ", $request->query) as $o) $origins[] = $o;

		// get notifications
		$notifications = Utils::getNotifications($request->userId, 20, $origins);
		foreach($notifications as $notification){
			$origin = $notification->origin;
			$origin = strtolower($origin);
			$notification->image = $servicesDir."$origin/$origin.png";
			$notification->origin = substr_replace($origin,strtoupper(substr($origin,0,1)),0,1);
			Utils::parseImgDir($notification->image);
		}
		// send response
		$response = new Response();
		$response->setResponseSubject("Sus notificaciones");
		$response->createFromTemplate('basic.ejs', ['notificactions' => $notifications]);
		return $response;
	}
}
