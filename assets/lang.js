// Map languages to ElevenLabs voice IDs
const voiceMap = {
  en: "Xb7hH8MSUJpSbSDYk0k2", // Alice (British English)
  fr: "R89ZQJowZAEgiPNyC3dQ", // Jeunot (French)
  zh: "bhJUNIXWQQ94l8eI2VUf"  // Amy (Mandarin)
};

// Optional translations (can expand later)
const translations = {
  en: {
    title: "AI Voice Changer",
    desc: "Upload your voice and hear it with a new accent or tone.",
    submit: "Transform My Voice"
  },
  fr: {
    title: "Changeur de Voix IA",
    desc: "Téléchargez votre voix et écoutez-la avec un nouvel accent.",
    submit: "Transformer ma voix"
  },
  zh: {
    title: "AI 语音变声器",
    desc: "上传你的语音并用新的声音听它。",
    submit: "转换语音"
  }
};

// Set default language on page load
const langSelect = document.getElementById("lang-select");
const langHidden = document.getElementById("lang-hidden");
const voiceHidden = document.getElementById("voice-hidden");
const loader = document.getElementById("loader");

// Apply text translations if used
const applyTranslations = (lang) => {
  if (!translations[lang]) return;
  document.querySelector("[data-i18n='title']").textContent = translations[lang].title;
  document.querySelector("[data-i18n='desc']").textContent = translations[lang].desc;
  document.querySelector("[data-i18n='submit']").textContent = translations[lang].submit;
};

// Update voice & language when dropdown changes
langSelect.addEventListener("change", (e) => {
  const lang = e.target.value;
  langHidden.value = lang;
  voiceHidden.value = voiceMap[lang];

  applyTranslations(lang); // if using translation tags
});

// On form submit: ensure correct values and show loader
document.getElementById("voice-form").addEventListener("submit", (e) => {
  const lang = langSelect.value;
  langHidden.value = lang;
  voiceHidden.value = voiceMap[lang];

  loader.style.display = "block";
});