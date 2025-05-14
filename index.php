<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>VoiceFX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <script src="assets/lang.js"></script>
</head>
<body data-theme="light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="#">
      <i class="bi bi-soundwave fs-3"></i> VoiceFX
    </a>
    <div class="d-flex align-items-center ms-auto gap-3">
      <select id="lang-select" class="form-select">
        <option value="en" selected>🇬🇧 English</option>
        <option value="fr">🇫🇷 Français</option>
        <option value="zh">🇨🇳 中文</option>
      </select>
      <button id="theme-toggle" class="btn btn-outline-light">🌙</button>
    </div>
  </div>
</nav>

<!-- Main Upload Form -->
<div class="container text-center mt-5">
  <div class="glass-card p-5 shadow-lg rounded-4">
    <h1 class="mb-4 animated-glow"><i class="bi bi-mic-fill"></i> AI Voice Changer</h1>
    <p class="lead mb-4">Upload your voice and hear it with a new accent or tone.</p>

    <form id="voice-form" action="upload.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="lang" id="lang-hidden" value="en">
      <input type="hidden" name="voice_id" id="voice-hidden" value="Xb7hH8MSUJpSbSDYk0k2">

      <div class="mb-3">
        <input type="file" name="audio" accept="audio/*" required class="form-control form-control-lg">
      </div>
      <button type="submit" class="btn btn-primary btn-lg px-4 py-2 mt-2">
        <i class="bi bi-stars"></i> Transform My Voice
      </button>
    </form>
    <div id="loader" class="mt-4" style="display: none;">
      <div class="waveform-loader">
        <span></span><span></span><span></span><span></span><span></span>
      </div>
      <p class="mt-3">Processing... please wait.</p>
    </div>
  </div>
</div>

</body>
</html>