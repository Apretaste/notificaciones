<?php

use Apretaste\Notifications;
use Apretaste\Request;
use Apretaste\Response;

class Service
{
	/**
	 * Entry point for the service
	 *
	 * @param Request $request
	 * @param Response $response
	 * @author salvipascual
	 */
	public function _main(Request $request, Response $response)
	{
		// return all alerts
		$this->_alerts($request, $response);
	}

	/**
	 * Get the list of alerts
	 *
	 * @param Request $request
	 * @param Response $response
	 * @author salvipascual
	 */
	public function _alerts(Request $request, Response $response)
	{
		// get all unread alerts
		$alerts = Notifications::getAlerts($request->person->id, 100);

		// error if there any no alerts 
		if(empty($alerts)) {
			return $response->setTemplate('empty.ejs');
		}

		// send data to the view
		$response->setTemplate('alerts.ejs', ['alerts' => $alerts]);
	}

	/**
	 * Get the list of user logs
	 *
	 * @param Request $request
	 * @param Response $response
	 * @author salvipascual
	 */
	public function _logs(Request $request, Response $response)
	{
		// get last 50 logs
		$logs = Notifications::getLogs($request->person->id, 50);

		// send data to the view
		$response->setTemplate('logs.ejs', ['logs' => $logs]);
	}

	/**
	 * Mark a alerts shown as read
	 *
	 * @author salvipascual
	 * @param Request
	 * @param Response
	 */
	public function _leer(Request $request, Response $response)
	{
		Notifications::markAlertGroupAsRead($request->input->data->id, $request->person->id);
	}

	/**
	 * Mark all alerts as read
	 *
	 * @author salvipascual
	 * @param Request
	 * @param Response
	 */
	public function _borrar(Request $request, Response $response)
	{
		// clear notifications
		Notifications::markAllAlertsAsRead($request->person->id);

		// return all alerts
		$this->_alerts($request, $response);
	}
}
