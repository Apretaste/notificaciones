// alerts counter
var totalCountOfAlerts = 0;

$(document).ready(function(){
	// get the notifications counter
	totalCountOfAlerts = (typeof alerts=='undefined') ? 0 : alerts.length;

	// render tabs
	$('.tabs').tabs();
});

// send the notificationd to be deleted
function deleteAlert(id) {
	// if is the last notification, update the app counter 
	if(totalCountOfAlerts <= 1 ) {
		deleteAllAlerts();
		return;
	}

	// else delete notification from the backend
	apretaste.send({
		command: 'NOTIFICACIONES LEER',
		data: {id: id},
		redirect: false
	});

	// and from the view and decrease counter
	$('#'+id).hide();
	totalCountOfAlerts--;
}

// clean all the notifications
function deleteAllAlerts() {
	apretaste.send({command: 'NOTIFICACIONES BORRAR'});
}
