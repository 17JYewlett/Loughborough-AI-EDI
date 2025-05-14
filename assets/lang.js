const voiceMap = {
  en: "Xb7hH8MSUJpSbSDYk0k2", // Alice (British English)
  fr: "R89ZQJowZAEgiPNyC3dQ", // Jeunot (French)
  zh: "bhJUNIXWQQ94l8eI2VUf"  // Amy (Mandarin)
};

const translations = {
  en: {
    title: "AI Voice Transformation",
    desc: "Upload your audio and convert it into a new voice or accent using ethical AI voice technology.",
    submit: "Transform Voice"
  },
  fr: {
    title: "Transformation vocale IA",
    desc: "Téléchargez votre audio et convertissez-le avec un nouvel accent grâce à l'IA éthique.",
    submit: "Transformer la voix"
  },
  zh: {
    title: "AI 语音转换器",
    desc: "上传音频，将其转换为新的语音或口音。",
    submit: "转换语音"
  }
};

// DOM elements
const langSelect = document.getElementById("lang-select");
const langSelectVisible = document.getElementById("lang-select-visible");
const langHidden = document.getElementById("lang-hidden");
const voiceHidden = document.getElementById("voice-hidden");
const loader = document.getElementById("loader");

const dropZone = document.getElementById("drop-zone");
const fileInput = document.getElementById("file-input");
const fileNameDisplay = document.getElementById("file-name");

// Sync translations
const applyTranslations = (lang) => {
  const t = translations[lang];
  if (!t) return;
  const titleEl = document.querySelector("[data-i18n='title']");
  const descEl = document.querySelector("[data-i18n='desc']");
  const submitEl = document.querySelector("[data-i18n='submit']");
  if (titleEl) titleEl.textContent = t.title;
  if (descEl) descEl.textContent = t.desc;
  if (submitEl) submitEl.textContent = t.submit;
};

// Unified language change handler
const updateLanguage = (lang) => {
  langHidden.value = lang;
  voiceHidden.value = voiceMap[lang];
  if (langSelectVisible) langSelectVisible.value = lang;
  applyTranslations(lang);
};

// Language dropdown
langSelect.addEventListener("change", (e) => {
  updateLanguage(e.target.value);
});

// Show loading animation on submit
document.getElementById("voice-form").addEventListener("submit", () => {
  loader.classList.remove("d-none");
});

// File name display handler
const updateFileName = (file) => {
  if (file) {
    fileNameDisplay.textContent = `Selected: ${file.name}`;
    fileNameDisplay.style.display = "block";
  } else {
    fileNameDisplay.style.display = "none";
  }
};

// Drag & drop styling
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
    fileInput.files = e.dataTransfer.files;
    updateFileName(file);
  }
});

// Manual file selection
fileInput.addEventListener("change", (e) => {
  const file = e.target.files[0];
  updateFileName(file);
});