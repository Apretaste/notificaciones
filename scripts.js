// notifications counter
var totalCountOfNotifications = 0;

//
// ON LOAD FUNCTIONS
//

$(document).ready(function(){
	totalCountOfNotifications = notifications.length;
	showScreensBasedOnCount();
});

//
// FUCTIONS FOR THE SERVICE
//

// send the notificationd to be deleted
function deleteNotification(id) {
	// delete from the backend
	apretaste.send({
		command: 'NOTIFICACIONES LEER',
		data: {id: id},
		redirect: false
	});

	// delete from screen and decrease counter
	$('#'+id).hide();
	totalCountOfNotifications--;

	// show message if all notifications were deleted
	showScreensBasedOnCount();
}

// display the notifications or the message based on the count
function showScreensBasedOnCount() {
	if(totalCountOfNotifications <= 0 ) {
		$('#no-notes').show();
		$('#yes-notes').hide();
	} else {
		$('#no-notes').hide();
		$('#yes-notes').show();
	}
}