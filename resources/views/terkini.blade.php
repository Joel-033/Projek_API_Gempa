<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gempa Terkini</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <a href="/" class="active">Gempa Terkini</a>
            <a href="/dirasakan">Gempa Dirasakan</a>
            <a href="/history">Riwayat Gempa</a>
        </nav>

        <h2 style="text-align: center;">Info Gempa Terkini</h2>

        <div class="action-box">
            <form action="/" method="GET">
                <button type="submit" name="tarik_data" value="1" class="btn-fetch">Tarik Data Sekarang</button>
                <span class="help-text">Klik tombol di atas untuk menarik data dari API</span>
            </form>
        </div>

        @if(isset($error))
            <div class="error-box">{{ $error }}</div>
        @endif

        @if(request()->has('tarik_data') && !isset($error))
            <div class="grid-container">
                @forelse($gempa as $g)
                <div class="card card-mini" style="border-top-color: #e74c3c;">
                    <div class="info-group">
                        <div class="info-label">Waktu</div>
                        <div class="info-value">{{ isset($g['datetime']) ? \Carbon\Carbon::parse($g['datetime'])->timezone('Asia/Jakarta')->locale('id')->translatedFormat('l, d F Y | H:i') . ' WIB' : '-' }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Kekuatan & Kedalaman</div>
                        <div class="info-value">
                        <span class="magnitude">{{ $g['magnitude'] ?? '-' }}</span> | Kedalaman: {{ $g['depth_km'] ?? '-' }} km
                        </div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Lokasi / Pusat Gempa</div>
                        <div class="info-value">{{ $g['region'] ?? '-' }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Potensi / Keterangan</div>
                        <div class="info-value" style="color: #d35400;">{{ $g['potential'] ?? '-' }}</div>
                    </div>
                </div>
                @empty
                    <p style="text-align: center; width: 100%;">Data kosong.</p>
                @endforelse
            </div>
        @endif
    </div>
</body>
</html>