<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Voice Changer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- Background Video -->
<video autoplay muted loop id="bg-video">
  <source src="assets/background.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>

<!-- Transparent Overlay -->
<div class="overlay d-flex flex-column justify-content-center align-items-center text-white">
  <h1 class="mb-4">AI Voice Changer</h1>

  <form action="upload.php" method="POST" enctype="multipart/form-data" class="text-center">
    <div class="mb-3">
      <input type="file" name="audio" accept="audio/*" required class="form-control">
    </div>
    <div class="mb-3">
      <label for="voice_id" class="form-label">Select Voice:</label>
      <select name="voice_id" class="form-select">
        <option value="default">Default</option>
        <option value="EXAVITQu4vr4xnSDxMaL">Voice 1</option>
        <option value="21m00Tcm4TlvDq8ikWAM">Voice 2</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Change My Voice</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>