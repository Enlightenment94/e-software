<script type="text/javascript">
// Stwórz nowe połączenie WebSocket
var socket = new WebSocket('ws://localhost:8080/');

// Otwórz połączenie WebSocket
socket.onopen = function(event) {
  // Wyślij wiadomość do serwera WebSocket
  socket.send('Hello, server!');
};

// Odbierz wiadomość z serwera WebSocket
socket.onmessage = function(event) {
  // Przetwórz otrzymane dane
  var data = event.data;
  console.log('Received data: ' + data);
};

// Obsłuż błąd połączenia WebSocket
socket.onerror = function(error) {
  console.log('WebSocket error: ' + error);
};

// Zamknij połączenie WebSocket
socket.onclose = function(event) {
  console.log('WebSocket closed: ' + event);
};
</script>