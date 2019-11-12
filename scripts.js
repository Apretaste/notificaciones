// alerts counter
var totalCountOfAlerts = 0;

//
// ON LOAD FUNCTIONS
//

$(document).ready(function(){
	totalCountOfAlerts = (typeof alerts=='undefined') ? 0 : alerts.length;
	showScreensBasedOnCount();

	// render tabs
	$('.tabs').tabs();
});

//
// FUCTIONS FOR THE SERVICE
//

// send the notificationd to be deleted
function deleteAlert(id) {
	// delete from the backend
	apretaste.send({
		command: 'NOTIFICACIONES LEER',
		data: {id: id},
		redirect: false
	});

	// delete from screen and decrease counter
	$('#'+id).hide();
	totalCountOfAlerts--;

	// show message if all alerts were deleted
	showScreensBasedOnCount();
}

// send the notificationd to be deleted
function deleteAllAlerts() {
	// delete from the backend
	apretaste.send({
		command: 'NOTIFICACIONES BORRAR',
		redirect: false
	});

	// decrease counter
	totalCountOfAlerts = 0;

	// show no message message 
	showScreensBasedOnCount();
}

// display the alerts or the message based on the count
function showScreensBasedOnCount() {
	if(totalCountOfAlerts <= 0 ) {
		$('#no-notes').show();
		$('#yes-notes').hide();
	} else {
		$('#no-notes').hide();
		$('#yes-notes').show();
	}
}