

// Get Domain and construct api path
const notificationApiPath = `${(new URL(window.location.href)).origin}/endpoints/notification_endpoint.php`;

// Fetch Every 2 seconds
setInterval(async () => {
    const response = await fetch(notificationApiPath);
    const notificationDTO = await response.json();

    // Check if notification has been received w/o errors
    if (notificationDTO.status) {
        addNotifications(notificationDTO.notifications);
    }

}, 5_000);

// Function for updating UI
function addNotifications(notification) {

    // Get Ref to Notification Container
    const notificationContainer = document.getElementById('parentDiv');

    // Create New Entry To Be Placed Under Container
    const newDiv = document.createElement('div');
    newDiv.setAttribute('id', 'myNewDiv');
    newDiv.textContent = 'This is the new div content';

    // Add New Entry
    notificationContainer.appendChild(newDiv);

}