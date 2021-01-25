// alerts counter
//
var totalCountOfAlerts = 0;

// on start ...
//
$(document).ready(function(){
	// get the notifications counter
	totalCountOfAlerts = (typeof alerts=='undefined') ? 0 : alerts.length;

	// render tabs
	$('.tabs').tabs();
});

// delete the alert group
//
function deleteAlertGroup(groupId) {
	// if is the last notification, update the app counter 
	if(totalCountOfAlerts <= 1 ) {
		deleteAllAlerts();
		return;
	}

	// else delete notification from the backend
	apretaste.send({
		command: 'NOTIFICACIONES LEER',
		data: {id: groupId},
		redirect: false,
		showLoading: false
	});

	// and from the view and decrease counter
	$('#'+groupId).hide();
	totalCountOfAlerts--;
}

// clean all the alerts
//
function deleteAllAlerts() {
	apretaste.send({command: 'NOTIFICACIONES BORRAR', showLoading: false});
}
