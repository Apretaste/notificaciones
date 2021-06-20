// alerts counter
//
var totalCountOfAlerts = 0;

// on start ...
//
$(document).ready(function(){
	// render tabs
	$('.tabs').tabs();

	// get the notifications counter
	if(typeof alerts=='undefined') {
		totalCountOfAlerts = 0;
	} else {
		totalCountOfAlerts = alerts.length;
		updateAlertCounters(alerts);
	}
});

// delete the alert group
//
function deleteAlertGroup(groupId) {
	// if is the last notification, update the app counter 
	if(totalCountOfAlerts <= 1 ) {
		deleteAllAlerts();
		return;
	}

	// decrese one the total counter
	var totalCounter = $('.counter-all span').html();
	$('.counter-all span').html(--totalCounter);

	// decrese one the icon counter
	var icon = $('#'+groupId).attr('icon');
	var iconCounter = $('.counter-'+icon+' span').html();
	if(iconCounter <= 1) $('.counter-'+icon).remove();
	else $('.counter-'+icon+' span').html(--iconCounter);

	// else delete notification from the backend
	apretaste.send({
		command: 'NOTIFICACIONES LEER',
		data: {id: groupId},
		redirect: false,
		showLoading: false
	});

	// and from the view and decrease counter
	$('#'+groupId).remove();
	totalCountOfAlerts--;
}

// clean all the alerts
//
function deleteAllAlerts() {
	apretaste.send({command: 'NOTIFICACIONES BORRAR', showLoading: false});
}

// calculate all the alert counters
//
function updateAlertCounters(alerts) {
	// count count of icon types
	var iconsCount = {};
	alerts.forEach(function(item) {
		if(iconsCount[item.icon]) iconsCount[item.icon]++;
		else iconsCount[item.icon] = 1;
	});

	// clear current counts
	var totalCount = (alerts.length >= 100) ? '100+' : alerts.length;
	$('#alertCounters').html('<span class="chip tiny icon grey counter-chip counter-all" onclick="filterAlerts(\'all\')"><i class="material-icons icon">notifications</i> <span>'+totalCount+'</span></span>');

	// create the alert counters
	Object.keys(iconsCount).forEach(function(key) {
		$('#alertCounters').append('<span class="chip tiny icon counter-chip counter-'+key+'" onclick="filterAlerts(\''+key+'\')"><i class="material-icons icon">'+key+'</i> <span>'+iconsCount[key]+'</span></span>');
	});
}

// filter alerts counter by icon
//
function filterAlerts(icon) {
	// color de counter
	$('.counter-chip').removeClass('grey');
	$('.counter-'+icon).addClass('grey');

	// filter by icon
	if(icon == 'all') $('.collection-item').show();
	else {
		$('.collection-item').hide();
		$('.collection-item[icon='+icon+']').show();
	}
}
