{{-- resources/views/emails/contact.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru - KontenDigital.id</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 40px 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; }

        /* Header */
        .header { background: #F2B038; border: 4px solid #000; padding: 32px; text-align: center; }
        .header-badge {
            display: inline-block; background: #000; color: #fff;
            font-weight: 900; font-size: 10px; letter-spacing: 3px;
            text-transform: uppercase; padding: 6px 16px; margin-bottom: 12px;
        }
        .header h1 {
            font-size: 32px; font-weight: 900; text-transform: uppercase;
            color: #000; line-height: 1.1;
        }
        .header h1 span { color: #fff; }

        /* Card */
        .card {
            background: #fff; border: 4px solid #000; border-top: 0;
            padding: 36px; box-shadow: 8px 8px 0 #000;
        }
        .greeting { font-size: 15px; color: #444; margin-bottom: 24px; line-height: 1.6; }

        /* Info table */
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 28px; }
        .info-table tr td { padding: 12px 14px; font-size: 14px; border: 3px solid #000; }
        .info-table tr td:first-child {
            background: #000; color: #F2B038; font-weight: 900;
            text-transform: uppercase; font-size: 11px; letter-spacing: 1px; width: 35%;
        }
        .info-table tr td:last-child { font-weight: 700; color: #111; }

        /* Message box */
        .message-label {
            font-weight: 900; font-size: 11px; text-transform: uppercase;
            letter-spacing: 2px; margin-bottom: 8px; color: #000;
        }
        .message-box {
            background: #fffde7; border: 3px solid #000;
            padding: 20px; font-size: 14px; color: #333; line-height: 1.8;
        }

        /* CTA */
        .cta-section {
            margin-top: 32px; background: #000;
            padding: 28px; text-align: center; border: 3px solid #000;
        }
        .cta-section p {
            color: #9ca3af; font-size: 13px; margin-bottom: 16px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        }
        .cta-btn {
            display: inline-block; background: #F2B038; color: #000;
            font-weight: 900; text-transform: uppercase; font-size: 14px;
            padding: 14px 28px; text-decoration: none; border: 3px solid #F2B038;
        }

        /* Footer */
        .footer { margin-top: 24px; text-align: center; font-size: 12px; color: #888; }
        .footer strong { color: #000; }
    </style>
</head>
<body>
<div class="wrapper">

    {{-- Header --}}
    <div class="header">
        <div class="header-badge">Pesan Masuk</div>
        <h1>KONTEN<span>DIGITAL</span>.ID</h1>
    </div>

    {{-- Card --}}
    <div class="card">
        <p class="greeting">
            Hei Admin! 👋<br><br>
            Ada pesan baru masuk melalui form kontak website. Berikut detailnya:
        </p>

        <table class="info-table">
            <tr>
                <td>Nama</td>
                <td>{{ $senderName }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $senderEmail }}</td>
            </tr>
            <tr>
                <td>No. WhatsApp</td>
                <td>{{ $senderPhone }}</td>
            </tr>
            <tr>
                <td>Layanan</td>
                <td>{{ $service }}</td>
            </tr>
        </table>

        <p class="message-label">Detail Kebutuhan:</p>
        <div class="message-box">
            {!! nl2br(e($userMessage)) !!}
        </div>

        <div class="cta-section">
            <p>Balas langsung ke pengirim via email</p>
            <a href="mailto:{{ $senderEmail }}" class="cta-btn">Balas → {{ $senderEmail }}</a>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Email ini dikirim otomatis dari <strong>KontenDigital.id</strong></p>
        <p style="margin-top:4px">Jangan balas email ini secara langsung.</p>
    </div>

</div>
</body>
</html>