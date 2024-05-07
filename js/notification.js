

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

    // Get Ref to Notification Container
    const notificationContainer = document.getElementById('notification-container');

    // Create New Entry To Be Placed Under Container
    // Example: <li><a class="dropdown-item" href="#"></a></li>
    const a_elem = document.createElement('a');
    a_elem.setAttribute('class', 'dropdown-item');
    a_elem.textContent = `${notification.NotificationBody}`;

    const li_elem = document.createElement('li');
    li_elem.setAttribute('id', notification.NotificationID);
    li_elem.appendChild(a_elem);

    // Add New Entry
    notificationContainer.appendChild(li_elem);

}