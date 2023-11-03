<?php
ini_set('display_errors', 1);

// Utwórz nowy serwer WebSocket na porcie 8080
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, 'localhost', 8080);
socket_listen($socket);

// Przeprowadź serwer w kółko, słuchając połączeń
while (true) {
    // Akceptuj nowe połączenia WebSocket
    $client = socket_accept($socket);
    $headers = '';

    // Odczytaj nagłówki zapytania WebSocket
    while ($buffer = trim(socket_read($client, 1024))) {
        $headers .= $buffer;
    }

    // Uzyskaj wartość klucza Sec-WebSocket-Key z nagłówka
    preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $headers, $matches);
    $key = base64_encode(pack(
        'H*',
        sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
    ));

    // Wyślij odpowiedź WebSocket
    $response_headers = "HTTP/1.1 101 Switching Protocols\r\n";
    $response_headers .= "Upgrade: websocket\r\n";
    $response_headers .= "Connection: Upgrade\r\n";
    $response_headers .= "Sec-WebSocket-Accept: $key\r\n";
    socket_write($client, $response_headers, strlen($response_headers));

    // Odczytuj dane z połączenia WebSocket
    while ($data = socket_read($client, 1024)) {
        // Zdekoduj dane zgodnie ze specyfikacją WebSocket
        $decoded_data = '';
        $length = ord($data[1]) & 127;
        if ($length === 126) {
            $masks = substr($data, 4, 4);
            $data = substr($data, 8);
        } elseif ($length === 127) {
            $masks = substr($data, 10, 4);
            $data = substr($data, 14);
        } else {
            $masks = substr($data, 2, 4);
            $data = substr($data, 6);
        }
        for ($i = 0; $i < strlen($data); ++$i) {
            $decoded_data .= $data[$i] ^ $masks[$i % 4];
        }

        // Wyświetl otrzymane dane
        echo $decoded_data;
    }

    // Zamknij połączenie WebSocket
    socket_close($client);
}