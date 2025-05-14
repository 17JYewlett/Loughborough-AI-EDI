<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>VoiceFX</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- Top Bar -->
<header class="d-flex justify-content-between align-items-center p-3 border-bottom bg-white">
  <div class="d-flex align-items-center gap-2">
    <i class="bi bi-mic-fill text-primary fs-4"></i>
    <strong class="fs-5">VoiceFX</strong>
  </div>
  <div class="d-flex gap-3 align-items-center">
    <select id="lang-select" class="form-select form-select-sm" style="width: 120px;">
      <option value="en" selected>🇬🇧 English</option>
      <option value="fr">🇫🇷 Français</option>
      <option value="zh">🇨🇳 中文</option>
    </select>
    <button id="theme-toggle" class="btn btn-outline-secondary btn-sm" title="Toggle theme">
      <i class="bi bi-sun-fill"></i>
    </button>
  </div>
</header>

<!-- Main Section -->
<main class="container py-5 text-center">
  <h1 class="mb-3 fw-bold fs-2" data-i18n="title">AI Voice Transformation</h1>
  <p class="mb-4 text-muted" data-i18n="desc">
    Upload your audio and convert it into a new voice or accent using ethical AI voice technology.
  </p>

  <form id="voice-form" action="upload.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
    <input type="hidden" name="lang" id="lang-hidden" value="en">
    <input type="hidden" name="voice_id" id="voice-hidden" value="Xb7hH8MSUJpSbSDYk0k2">

    <!-- Upload Box -->
    <div class="border border-2 rounded p-4 mb-4 position-relative" id="drop-zone">
      <label for="file-input" class="form-label w-100 text-muted" style="cursor: pointer;" id="drop-label">
        <p class="text-success mt-2 fw-semibold" id="file-name" style="display:none;"></p>
        <i class="bi bi-upload fs-1 d-block mb-2 text-primary"></i>
        <span>Drag & drop your audio here, or click to select</span><br>
        <small class="text-muted">MP3 or WAV, max 30 seconds</small>
      </label>
      <input type="file" name="audio" id="file-input" accept="audio/*" required class="form-control d-none">
    </div>

    <!-- Accent Selection -->
    <div class="mb-4">
  <label class="form-label fw-semibold">Accent</label>
  <select class="form-select" id="lang-select-visible" disabled>
    <option value="en">British English - Alice</option>
    <option value="fr">Français - Jeunot</option>
    <option value="zh">普通话 - 艾米</option>
  </select>
</div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary btn-lg w-100" data-i18n="submit">
      <i class="bi bi-stars me-2"></i> Transform Voice
    </button>

    <!-- Loading -->
    <div id="loader" class="mt-4 d-none">
      <div class="waveform-loader mx-auto">
        <span></span><span></span><span></span><span></span><span></span>
      </div>
      <p class="mt-3 text-muted">Processing... Please wait.</p>
    </div>
  </form>
</main>

<!-- Footer -->
<footer class="text-center text-muted small py-3 border-top">
  © <?= date("Y") ?> VoiceFX. All rights reserved.
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/lang.js"></script>
</body>
</html>