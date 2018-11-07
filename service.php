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
		if($request->query) foreach (explode(" ", $request->query) as $o) $origins[] = $o;

		// get notifications
		$notifications = Utils::getNotifications($request->userId, 20, $origins);

		// send response
		$response = new Response();
		$response->setResponseSubject("Sus notificaciones");
		$response->createFromTemplate('basic.tpl', ['notificactions' => $notifications]);
		return $response;
	}
}
