<?php

class Service
{
	/**
	 * Entry point for the service
	 *
	 * @author salvipascual
	 * @param Request
	 * @param Response
	 */
	public function _main(Request $request, Response $response)
	{
		// return all alerts
		$this->_alerts($request, $response);
	}

	/**
	 * Get the list of alerts
	 *
	 * @author salvipascual
	 * @param Request
	 * @param Response
	 */
	public function _alerts(Request $request, Response $response)
	{
		// get all unread alerts
		$alerts = Notifications::getAlerts($request->person->id);

		// send data to the view
		$response->setTemplate('alerts.ejs', ["alerts" => $alerts]);
	}

	/**
	 * Get the list of user logs
	 *
	 * @author salvipascual
	 * @param Request
	 * @param Response
	 */
	public function _logs(Request $request, Response $response)
	{
		// get last 50 logs
		$logs = Notifications::getLogs($request->person->id, 50);

		// send data to the view
		$response->setTemplate('logs.ejs', ["logs" => $logs]);
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
		Notifications::markAlertAsRead($request->input->data->id, $request->person->id);
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
		Notifications::markAllAlertsAsRead($request->person->id);
	}
}
