from elevenlabs import ElevenLabs
client = ElevenLabs(
    api_key="sk_e78f5b4bb2a54a10092f82ae2445a3a3eba8d4c9db08df5d",
)
x = client.voices.get_settings(
    voice_id="R89ZQJowZAEgiPNyC3dQ",
)

x = str(x)
x = x.split(" ")
for stuff in x:
    print(stuff)
    print("*" * 20)

# from elevenlabs import ElevenLabs, VoiceSettings

# client = ElevenLabs(
#     api_key="sk_e78f5b4bb2a54a10092f82ae2445a3a3eba8d4c9db08df5d",
# )
# client.voices.edit_settings(
#     voice_id="R89ZQJowZAEgiPNyC3dQ",
#     request=VoiceSettings(
#         stability=0.20,
#         similarity_boost=0.20,
#         style=0.0,
#         use_speaker_boost=True,
#         speed=1.0,
#     ),
# )
