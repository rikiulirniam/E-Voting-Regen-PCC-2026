<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kredensial Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 520px; margin: 40px auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: #1d4ed8; padding: 28px 32px; text-align: center; }
        .header h1 { color: #ffffff; font-size: 20px; margin: 0; }
        .body { padding: 32px; color: #374151; }
        .greeting { font-size: 16px; margin-bottom: 16px; }
        .info-box { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 20px 24px; margin: 20px 0; }
        .info-box p { margin: 6px 0; font-size: 14px; }
        .info-box strong { display: inline-block; width: 100px; color: #1e3a8a; }
        .credential { font-family: monospace; font-size: 15px; color: #1d4ed8; background: #dbeafe; padding: 2px 6px; border-radius: 4px; }
        .note { font-size: 13px; color: #6b7280; margin-top: 20px; border-top: 1px solid #e5e7eb; padding-top: 16px; }
        .footer { background: #f9fafb; padding: 16px 32px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="container">

        <div class="body">
            <p class="greeting">Halo, <strong>{{ $peserta->name }}</strong>!</p>
            <p>Berikut adalah kredensial login Anda untuk mengikuti <strong>Regenerasi PCC 2026</strong>:</p>

            <div class="info-box">
                <p><strong>NIM</strong> : {{ $peserta->nim }}</p>
                <p><strong>Username</strong> : <span class="credential">{{ $username }}</span></p>
                <p><strong>Password</strong> : <span class="credential">{{ $plainPassword }}</span></p>
            </div>

            <p>Gunakan username dan password di atas untuk masuk ke sistem voting.</p>

            <p class="note">
                Email ini dikirim secara otomatis oleh sistem. Harap simpan kredensial ini dengan aman dan jangan bagikan kepada siapapun.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Regenerasi PCC 2026 &mdash; Pesan ini dibuat otomatis, jangan membalas email ini.
        </div>
    </div>
</body>
</html>
