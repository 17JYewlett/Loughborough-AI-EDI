<?php

$apiKey = 'sk_e78f5b4bb2a54a10092f82ae2445a3a3eba8d4c9db08df5d';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voiceId = $_POST['voice_id'] ?? 'Xb7hH8MSUJpSbSDYk0k2'; // Default to Alice (English)

    if (!isset($_FILES['audio']) || $_FILES['audio']['error'] !== UPLOAD_ERR_OK) {
        die("Error: Audio file not uploaded.");
    }

    $filePath = $_FILES['audio']['tmp_name'];
    $fileName = $_FILES['audio']['name'];
    $mimeType = mime_content_type($filePath);

    $url = "https://api.elevenlabs.io/v1/speech-to-speech/$voiceId/stream";

    $postFields = [
        'model_id' => 'eleven_multilingual_sts_v2',
        'output_format' => 'mp3_44100_128',
        'audio' => new CURLFile($filePath, $mimeType, $fileName)
    ];

    $headers = [
        "xi-api-key: $apiKey"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        header('Content-Type: audio/mpeg');
        header('Content-Disposition: attachment; filename="converted.mp3"');
        echo $response;
    } else {
        header('Content-Type: text/plain');
        echo "API Error (HTTP $httpCode):\n$response";
    }
}