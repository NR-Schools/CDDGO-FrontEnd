

// Get Domain and construct api path
const notificationApiPath = `${(new URL(window.location.href)).origin}/endpoints/notification_endpoint.php`;

// Fetch Every 2 seconds
setInterval(async () => {
    const response = await fetch(notificationApiPath);
    const notificationDTO = await response.json();

    // Check if notification has been received w/o errors
    if (notificationDTO.status) {
        for (const notification of notificationDTO.notifications) {
            addNotification(notification);
        }
    }

}, 5_000);

// Function for updating UI
function addNotification(notification) {

    // Show Red Dot
    const redDot = document.getElementById("notification-red-dot");
    redDot.style.opacity = 1;

    // Add Notification
    const notificationContainer = document.getElementById('notification-container');
    newNotifDisplay = `
    <li class="alert alert-success" style="margin-bottom: 10px; background-color: #9e0671; color: white; padding-bottom: 0px">
        <p>${notification.NotificationTitle}</p>
        <p>${notification.NotificationBody}</p=>
    </li>
    `;
    notificationContainer.innerHTML = notificationContainer.innerHTML + newNotifDisplay;
}

function openNotification() {
    // Hide Red Dot
    const redDot = document.getElementById("notification-red-dot");
    redDot.style.opacity = 0;

}