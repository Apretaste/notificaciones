$(document).ready(() => {
    notificactions.forEach((notification) => {
        let date = new Date(notification.inserted_date);
        $('#'+date.getTime()).click(() => {
            apretaste.send({"command":notification.link});
            return false;
        });
    });
});