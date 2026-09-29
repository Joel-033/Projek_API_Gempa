<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gempa Dirasakan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <a href="/">Gempa Terkini</a>
            <a href="/dirasakan" class="active">Gempa Dirasakan</a>
            <a href="/history">Riwayat Gempa</a>
        </nav>

        <h2 style="text-align: center;">Daftar Gempa Dirasakan</h2>

        <div class="action-box">
            <form action="/dirasakan" method="GET">
                <button type="submit" name="tarik_data" value="1" class="btn-fetch">Tarik Data Dirasakan</button>
                <span class="help-text">Klik tombol di atas untuk menarik data dari API (-2 Kredit)</span>
            </form>
        </div>

        @if(isset($error))
            <div class="error-box">{{ $error }}</div>
        @endif

        @if(request()->has('tarik_data') && !isset($error))
            <div class="grid-container">
                @forelse($gempaList as $gempa)
                <div class="card card-mini" style="border-top-color: #3498db;">
                    <div class="info-group">
                        <div class="info-label">Waktu</div>
                        <!-- Diubah ke 'datetime' -->
                        <div class="info-value">{{ $gempa['datetime'] ?? '-' }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Kekuatan & Kedalaman</div>
                        <!-- Diubah ke 'magnitude' dan 'depth_km' -->
                        <div class="info-value">
                            <span class="magnitude">{{ $gempa['magnitude'] ?? '-' }}</span> | Kedalaman: {{ $gempa['depth_km'] ?? '-' }} km
                        </div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Pusat Gempa</div>
                        <!-- Diubah ke 'region' -->
                        <div class="info-value">{{ $gempa['region'] ?? '-' }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Dirasakan (Skala MMI)</div>
                        <!-- Diubah ke 'felt_areas' sesuai hasil dd() -->
                        <div class="info-value" style="color:#d35400;">{{ $gempa['felt_areas'] ?? '-' }}</div>
                    </div>
                </div>
                @empty
                    <p style="text-align: center; width: 100%;">Data kosong atau belum tersedia.</p>
                @endforelse
            </div>
        @endif
    </div>
</body>
</html>