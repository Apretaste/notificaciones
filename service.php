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
		$servicesDir = \Phalcon\DI\FactoryDefault::getDefault()->get('path')['root'].'/services/';
		if(isset($data->services)) foreach ($data->services as $o) $origins[] = $o;

		// get notifications
		$notifications = Utils::getNotifications($request->person->id, 20, $origins);
		foreach($notifications as $notification){
			$origin = $notification->origin;
			$origin = strtolower($origin);
			$notification->image = "icons/$origin.png";
			$notification->origin = substr_replace($origin,strtoupper(substr($origin,0,1)),0,1);
		}

		$response->setTemplate('basic.ejs', ['notificactions' => $notifications]);
	}
}
