<?php

/**
 * Service NOTIFICACIONES
 * @author kumahacker <kumahavana@gmail.com>
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
		// i.E.: NOTIFICACIONES pizarra nota chat
		$origin = "";
		if($request->query) {
			foreach (explode(" ", $request->query) as $o) $origins[] = "origin LIKE '$o%'";
			$origin = implode(" OR ", $origins);
			$origin = "AND ($origin)";
		}

		// create SQL to get notifications
		$connection = new Connection();
		$notifications = $connection->query("
			SELECT *
			FROM notifications
			WHERE email='{$request->email}'
			$origin
			ORDER BY inserted_date DESC
			LIMIT 20");

		// mark all notifications as seen
		if($notifications) {
			$connection->query("UPDATE notifications SET viewed=1, viewed_date=CURRENT_TIMESTAMP WHERE email='{$request->email}'");
		}

		// send response
		$response = new Response();
		$response->setResponseSubject("Sus notificaciones");
		$response->createFromTemplate('basic.tpl', ['notificactions'=>$notifications]);
		return $response;
	}
}
