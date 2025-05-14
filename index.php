<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>VoiceFX - AI Voice Transformation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <style>
    .hero-3d {
      transition: transform 0.3s ease, text-shadow 0.3s ease;
      transform-style: preserve-3d;
    }
    .hero-3d:hover {
      transform: translateY(-5px) scale(1.05);
    }

    .btn-3d {
      box-shadow: 0 4px #0056b3;
      transform: translateY(0);
      transition: all 0.1s ease-in-out;
    }

    .btn-3d:active {
      box-shadow: 0 2px #004494;
      transform: translateY(2px);
    }
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f2f6ff, #dbe9ff);
      color: #333;
      transition: background 0.3s ease, color 0.3s ease;
    }
    body.dark-mode {
      background: #121212;
      color: #eee;
    }
    body.dark-mode .file-upload-zone {
      background: #1e1e1e;
      border-color: #555;
    }
    body.dark-mode input,
    body.dark-mode select,
    body.dark-mode label,
    body.dark-mode .form-label,
    body.dark-mode #file-label {
      color: #ddd;
    }
    body.dark-mode .navbar {
      background: #1f1f1f;
      color: #eee;
    }
    .navbar {
      background: white;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(15px);
      border-radius: 1.5rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    body.dark-mode .glass-card {
      background: rgba(30, 30, 30, 0.6);
    }
    .glass-card:hover {
      transform: translateY(-5px);
    }
    .btn-primary {
      background: linear-gradient(135deg, #007bff, #0056b3);
      border: none;
    }
    .waveform-loader span {
      width: 6px;
      height: 30px;
      background: #0d6efd;
      display: inline-block;
      animation: pulse 1s infinite ease-in-out;
    }
    .waveform-loader span:nth-child(2) { animation-delay: 0.1s; }
    .waveform-loader span:nth-child(3) { animation-delay: 0.2s; }
    .waveform-loader span:nth-child(4) { animation-delay: 0.3s; }
    .waveform-loader span:nth-child(5) { animation-delay: 0.4s; }

    @keyframes pulse {
      0%, 100% { transform: scaleY(0.5); opacity: 0.6; }
      50% { transform: scaleY(1); opacity: 1; }
    }
    .file-upload-zone {
      border: 2px dashed #ccc;
      padding: 2rem;
      border-radius: 1rem;
      background: white;
      transition: 0.3s ease all;
      color: inherit;
    }
    .file-upload-zone.dragover {
      background: #e9f2ff;
      border-color: #0d6efd;
    }
    .dark-mode .file-upload-zone {
      background: #1e1e1e;
      border-color: #555;
      color: #ddd;
    }
    audio {
      width: 100%;
      margin-top: 1rem;
    }
    canvas#waveform {
      width: 100%;
      height: 80px;
      display: block;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-light px-4">
  <div class="container-fluid d-flex justify-content-between">
    <a class="navbar-brand d-flex align-items-center gap-2 fw-semibold fs-5" href="#">
      <i class="bi bi-soundwave text-primary fs-4"></i> VoiceFair
    </a>
    <div class="d-flex gap-3">
      <select id="lang-select" class="form-select">
        <option value="en" selected>🇬🇧 English</option>
        <option value="fr">🇫🇷 French</option>
        <option value="zh">🇨🇳 Mandarin</option>
      </select>
      <button id="theme-toggle" class="btn btn-outline-dark" title="Toggle theme">
        <i class="bi bi-circle-half"></i>
      </button>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
  <div class="glass-card p-5 mx-auto" style="max-width: 700px;">
    <h1 class="text-center mb-3 hero-3d" data-i18n="heading">VoiceFair voice bias eliminator</h1>
    <p class="text-center text-muted mb-4" data-i18n="subtitle">eliminate bias by changing your voice to a different accent, different languages are available but it must be done in same language</p>

    <form id="voice-form" action="upload.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="lang" id="lang-hidden" value="en">
      <input type="hidden" name="voice_id" id="voice-hidden" value="Xb7hH8MSUJpSbSDYk0k2">

      <div id="drop-zone" class="file-upload-zone text-center mb-3">
        <label for="file-input" class="form-label">
          <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i><br>
          <span id="file-label">Drag and drop or click to upload your audio</span>
        </label>
        <input type="file" name="audio" id="file-input" accept="audio/*" class="form-control d-none">
      </div>

      <div class="text-center mb-3">
        <button type="button" class="btn btn-outline-secondary btn-3d" id="record-btn" data-i18n="record">
          <i class="bi bi-mic"></i> Record Audio
        </button>
      </div>

      <div class="mb-4">
        <button type="submit" class="btn btn-primary w-100 btn-3d" data-i18n="button">
          <i class="bi bi-stars"></i> Transform Voice
        </button>
      </div>
    </form>

    <div id="loader" class="text-center d-none">
      <div class="waveform-loader">
        <span></span><span></span><span></span><span></span><span></span>
      </div>
      <p class="mt-3" id="processing-text" data-i18n="processing">Processing... Please wait.</p>
    </div>

    <div id="voice-display" class="text-center text-muted mb-3">Using Voice ID: Xb7hH8MSUJpSbSDYk0k2</div>
    <div id="audio-player" class="d-none">
      <p class="fw-semibold" data-i18n="playback">🎧 Playback Transformed Audio:</p>
      <audio controls id="audio-result"></audio>
      <canvas id="waveform"></canvas>
    </div>
    <!-- Transcript display, will be shown after audio is played and transcript is fetched -->
    <div id="transcript-box" class="mt-4 d-none">
      <h5>Transcript</h5>
      <textarea id="transcript-text" class="form-control" rows="4" readonly></textarea>
    </div>
  </div>
</div>

<!-- Bootstrap + JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const langSelect = document.getElementById("lang-select");
  const langHidden = document.getElementById("lang-hidden");
  const voiceHidden = document.getElementById("voice-hidden");
  const fileInput = document.getElementById("file-input");
  const dropZone = document.getElementById("drop-zone");
  const fileLabel = document.getElementById("file-label");
  const loader = document.getElementById("loader");
  const audioPlayer = document.getElementById("audio-player");
  const audioResult = document.getElementById("audio-result");
  const waveformCanvas = document.getElementById("waveform");
  const ctx = waveformCanvas.getContext("2d");
  const themeToggle = document.getElementById("theme-toggle");
  const voiceMap = {
    en: "Xb7hH8MSUJpSbSDYk0k2",
    fr: "R89ZQJowZAEgiPNyC3dQ",
    zh: "bhJUNIXWQQ94l8eI2VUf"
  };

  const translations = {
    en: {
      heading: "🎙️ AI Voice Transformer",
      subtitle: "Upload or record your voice. Select an accent. Hear yourself like never before.",
      record: "Record Audio",
      button: "Transform Voice",
      processing: "Processing... Please wait.",
      playback: "🎧 Playback Transformed Audio:"
    },
    fr: {
      heading: "🎙️ Transformateur de Voix IA",
      subtitle: "Téléchargez ou enregistrez votre voix. Sélectionnez un accent. Entendez-vous comme jamais auparavant.",
      record: "Enregistrer Audio",
      button: "Transformer la Voix",
      processing: "Traitement... Veuillez patienter.",
      playback: "🎧 Lecture de l'audio transformé :"
    },
    zh: {
      heading: "🎙️ AI 语音转换器",
      subtitle: "上传或录制您的声音。选择口音。以前所未有的方式听到自己。",
      record: "录制音频",
      button: "转换语音",
      processing: "处理中... 请稍候。",
      playback: "🎧 播放转换后的音频："
    }
  };

  function applyTranslations(lang) {
    document.querySelectorAll("[data-i18n]").forEach(el => {
      const key = el.getAttribute("data-i18n");
      if(translations[lang] && translations[lang][key]) {
        el.textContent = translations[lang][key];
      }
    });
  }

  langSelect.addEventListener("change", (e) => {
    const lang = e.target.value;
    langHidden.value = lang;
    voiceHidden.value = voiceMap[lang];
    document.getElementById("voice-display").textContent = `Using Voice ID: ${voiceMap[lang]}`;
    document.documentElement.lang = lang;
    applyTranslations(lang);
  });

  themeToggle.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
  });

  dropZone.addEventListener("click", () => fileInput.click());
  dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZone.classList.add("dragover");
  });
  dropZone.addEventListener("dragleave", () => {
    dropZone.classList.remove("dragover");
  });
  dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropZone.classList.remove("dragover");
    if (e.dataTransfer.files.length) {
      const file = e.dataTransfer.files[0];
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      fileInput.files = dataTransfer.files;
      fileLabel.textContent = `Selected: ${file.name}`;
      fileInput.dispatchEvent(new Event('change'));
    }
  });

  fileInput.addEventListener("change", (e) => {
    if (e.target.files[0]) {
      fileLabel.textContent = `Selected: ${e.target.files[0].name}`;
    }
  });

  document.getElementById("voice-form").addEventListener("submit", (e) => {
    e.preventDefault();
    loader.classList.remove("d-none");
    audioPlayer.classList.add("d-none");
    // Hide transcript box before processing
    document.getElementById("transcript-box").classList.add("d-none");

    const formData = new FormData(e.target);
    fetch("upload.php", {
      method: "POST",
      body: formData
    }).then(res => res.blob()).then(blob => {
      loader.classList.add("d-none");
      audioPlayer.classList.remove("d-none");
      const url = URL.createObjectURL(blob);
      audioResult.src = url;
      audioResult.play();
      drawWaveform(blob);

      // Fetch and display transcript after playing audio
      fetch("transcribe.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        const transcriptBox = document.getElementById("transcript-box");
        const transcriptText = document.getElementById("transcript-text");
        transcriptText.value = data.transcript || "Transcript unavailable.";
        transcriptBox.classList.remove("d-none");
      });
      // Note: You need to create a new PHP file 'transcribe.php' that handles transcription
      // (e.g., using Whisper API or a placeholder returning fake text for now).
    }).catch(err => {
      loader.classList.add("d-none");
      alert("Error: " + err);
    });
  });

  function drawWaveform(blob) {
    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    const reader = new FileReader();
    reader.onload = () => {
      audioCtx.decodeAudioData(reader.result).then(buffer => {
        const data = buffer.getChannelData(0);
        const step = Math.ceil(data.length / waveformCanvas.width);
        const amp = waveformCanvas.height / 2;
        ctx.clearRect(0, 0, waveformCanvas.width, waveformCanvas.height);
        for (let i = 0; i < waveformCanvas.width; i++) {
          const min = Math.min(...data.slice(i * step, (i + 1) * step));
          const max = Math.max(...data.slice(i * step, (i + 1) * step));
          ctx.fillStyle = '#0d6efd';
          ctx.fillRect(i, (1 + min) * amp, 1, Math.max(1, (max - min) * amp));
        }
      });
    };
    reader.readAsArrayBuffer(blob);
  }

  let mediaRecorder;
  let chunks = [];
  document.getElementById("record-btn").addEventListener("click", async () => {
    if (!navigator.mediaDevices) {
      return alert("Your browser does not support audio recording.");
    }

    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    mediaRecorder = new MediaRecorder(stream);
    chunks = [];

    mediaRecorder.ondataavailable = e => chunks.push(e.data);
    mediaRecorder.onstop = () => {
      const blob = new Blob(chunks, { type: 'audio/webm' });
      const file = new File([blob], "recording.webm", { type: 'audio/webm' });
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      fileInput.files = dataTransfer.files;
      fileLabel.textContent = `Selected: recording.webm`;
    };

    mediaRecorder.start();
    document.getElementById("record-btn").textContent = "Stop Recording";

    document.getElementById("record-btn").onclick = () => {
      mediaRecorder.stop();
      document.getElementById("record-btn").textContent = "Record Audio";
    };
  });

   // Initialize voice ID on page load
  window.addEventListener('DOMContentLoaded', () => {
    langSelect.dispatchEvent(new Event('change'));
  });
</script>
</body>
</html>