<?php

/**
 * Apretaste!
 * 
 * Service NOTIFICACIONES
 * 
 * @author kumahacker <kumahavana@gmail.com>
 *
 */
class Notificaciones extends Service
{
	/**
	 * Get the list of conversations
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request)
	{
		
		$sql = "SELECT * FROM notifications WHERE email ='{$request->email}' ORDER BY inserted_date DESC LIMIT 50;";
		$connection = new Connection();
		$notifications = $connection->deepQuery($sql);
		
		if ( ! is_array($notifications))
			$notifications = array();
		
		$non_viewed = $this->utils->getNumberOfNotifications($request->email);
		
		$response = new Response();
		$subject = "Tienes $non_viewed notificaciones sin leer";
		
		if ($non_viewed * 1 === 1)
			$subject = "Tienes una notificacion sin leer";
		
		if ($non_viewed * 1 < 1)
			$subject  = "Ultimas 50 notificaciones";
				
		if (count($notifications) < 1)
		{
			$response->setResponseSubject("No tienes aun notificaciones.");
			$response->createFromText("No tienes aun notificaciones. Servicios como Pizarra o Cupido, mensajes de otros usuarios o eventos del sistema tales como importantes cambios en Apretaste se le mostraran en esta secci&oacute;n para que siempre est&eacute; al tanto de lo que ocurre.");
			return $response;
		}
		
		$response->setResponseSubject($subject);
		$responseContent = array(
			'notificactions' => $notifications
		);
		
		$response->createFromTemplate('basic.tpl', $responseContent);
		
		// Mark as seen 
		$connection->deepQuery("UPDATE notifications SET viewed = 1, viewed_date = CURRENT_TIMESTAMP WHERE email ='{$request->email}'");
		
		return $response;
	}
}