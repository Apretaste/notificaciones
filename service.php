<?php

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
		// get all unread notifications
		$notifications = Connection::query("
			SELECT id,`to`,service,icon,`text`,link,alert,inserted 
			FROM notification
			WHERE `to` = {$request->person->id} 
			AND `read` IS NULL");

		// send data to the view
		$response->setTemplate('notifications.ejs', ["notifications"=>$notifications]);
	}

	/**
	 * Mark a notifications shown as read
	 *
	 * @param Request
	 * @param Response
	 * */
	public function _leer(Request $request, Response $response)
	{
		// mark notification as read
		Connection::query("UPDATE notification SET `read`=CURRENT_TIMESTAMP WHERE id={$request->input->data->id}");

		// decrease the number of notifications
		if($request->person->notifications > 0) {
			Connection::query("UPDATE person SET notifications=notifications-1 WHERE id={$request->person->id}");
		}
	}
}
