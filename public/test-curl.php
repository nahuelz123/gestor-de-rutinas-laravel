<?php



// Obtener la clave API
$apiKey = getenv('OPENAI_API_KEY');

// Añadir var_dump para verificar el valor de la clave API
var_dump($apiKey); // Esto debería mostrar la clave API si se carga correctamente

if (!$apiKey) {
    die('La clave API no está definida.');
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'model' => 'gpt-3.5-turbo',
    'messages' => [['role' => 'user', 'content' => 'Hola, ¿qué puedes hacer?']],
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey,
]);

$output = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    echo 'Conexión exitosa: ' . $output;
}

curl_close($ch);
