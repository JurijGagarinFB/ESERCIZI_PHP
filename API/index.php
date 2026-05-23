<?php
require __DIR__ . '/vendor/autoload.php';
$client = new \GuzzleHttp\Client(['base_uri' => 'https://jsonplaceholder.typicode.com/']);

try {
    $response = $client->request('GET', 'todos/');
    $data = json_decode($response->getBody(), true);
    foreach ($data as $todo) {
        echo 'userId: ' . $todo['userId'] . '<br>';
        echo 'id: ' . $todo['id'] . '<br>';
        echo 'title: ' . $todo['title'] . '<br>';
        echo '<hr>';
    }
} catch (\GuzzleHttp\Exception\ClientException $e) {
}