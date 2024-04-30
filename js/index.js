

const evtSource = new EventSource("http://localhost:8080/live/notification-sse.php");


evtSource.onmessage = (event) => {
    console.log(event);
}