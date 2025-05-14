<?php
$apiKey = getenv('ELEVEN_LABS_API_KEY');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['audio']['tmp_name'];
        $voiceId = $_POST['voice_id'] ?? 'default';

        $audioContent = file_get_contents($fileTmpPath);

        // First step: (Optional) Use Speech-to-Text if needed
        // For now, assume we skip that and already have the content (or it’s text input-based)

        // Step: Send to Text-to-Speech (using predefined text for now)
        $url = "https://api.elevenlabs.io/v1/text-to-speech/$voiceId";

        $data = [
            'text' => 'This is your changed voice using ElevenLabs.',
            'voice_settings' => [
                'stability' => 0.75,
                'similarity_boost' => 0.75
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'xi-api-key: ' . $apiKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
            header('Content-Type: audio/mpeg');
            header('Content-Disposition: attachment; filename="converted.mp3"');
            echo $response;
        } else {
            echo 'Error: ' . $response;
        }

        curl_close($ch);
    } else {
        echo "File upload error.";
    }
} else {
    echo "Invalid request.";
}