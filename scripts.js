//
// ON LOAD FUNCTIONS
//

$(document).ready(function(){
	showScreensBasedOnCount(notifications.length);
});

//
// FUCTIONS FOR THE SERVICE
//

// send the notificationd to be deleted
function deleteNotification(id) {
	apretaste.send({
		command: 'NOTIFICACIONES LEER',
		data: {id: id},
		redirect: false,
		callback: {
			name: "callbackDeleteNotification", 
			data: {id: id}
		}
	});
}

// display the notifications or the message based on the count
function showScreensBasedOnCount(count) {
	if(count <= 0 ) {
		$('#no-notes').show();
		$('#yes-notes').hide();
	} else {
		$('#no-notes').hide();
		$('#yes-notes').show();
	}
}

//
// CALLBACKS
//

function callbackDeleteNotification(data) {
	// delete notification
	$('#'+data.id).fadeOut(function() {
		$(this).remove();

		// show message if all notifications were deleted
		var count = $("ul.collection li").length;
		showScreensBasedOnCount(count);
	});
}