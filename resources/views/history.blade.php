<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Gempa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <a href="/">Gempa Terkini</a>
            <a href="/dirasakan">Gempa Dirasakan</a>
            <a href="/history" class="active">Riwayat Gempa</a>
        </nav>

        <h2 style="text-align: center;">Riwayat Gempa (M 5.0+)</h2>

        <div class="action-box">
            <form action="/history" method="GET" class="history-form">
                <div>
                    <label style="font-size: 12px; display:block;">Dari Tanggal:</label>
                    <input type="date" name="start" value="{{ $startDate }}" required>
                </div>
                <div>
                    <label style="font-size: 12px; display:block;">Sampai Tanggal:</label>
                    <input type="date" name="end" value="{{ $endDate }}" required>
                </div>
                <div style="margin-top: 18px;">
                    <button type="submit" name="tarik_data" value="1" class="btn-fetch">Cari & Tarik Riwayat</button>
                </div>
            </form>
            <span class="help-text" style="margin-top: 15px;">Pilih tanggal, lalu klik tombol untuk menarik data dari API (-2 Kredit)</span>
        </div>

        @if(isset($error))
            <div class="error-box">{{ $error }}</div>
        @endif

            @if(request()->has('tarik_data') && !isset($error))
            <div class="grid-container">
                @forelse($gempaList as $riwayat)
                <div class="card card-history" style="border-top-color: #f39c12;">
                    <div class="info-group">
                        <div class="info-label">Waktu</div>
                        <!-- Key: datetime -->
                        <div class="info-value">{{ $riwayat['datetime'] ?? '-' }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Kekuatan & Kedalaman</div>
                        <!-- Key: magnitude & depth_km -->
                        <div class="info-value">
                            <span class="magnitude">{{ $riwayat['magnitude'] ?? '-' }}</span> | Kedalaman: {{ $riwayat['depth_km'] ?? '-' }} km
                        </div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Pusat Gempa</div>
                        <!-- Key: region -->
                        <div class="info-value">{{ $riwayat['region'] ?? '-' }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Potensi</div>
                        <!-- Key: potential -->
                        <div class="info-value" style="color: #d35400;">{{ $riwayat['potential'] ?? '-' }}</div>
                    </div>
                </div>
                @empty
                    <p style="text-align: center; width: 100%;">Tidak ada data riwayat gempa pada rentang tanggal tersebut.</p>
                @endforelse
            </div>
        @endif
    </div>
</body>
</html>