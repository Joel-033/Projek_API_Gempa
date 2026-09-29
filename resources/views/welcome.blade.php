<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Gempa Terkini - Tugas Kelompok</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); max-width: 450px; width: 100%; overflow: hidden; }
        .card-header { background: #e74c3c; color: white; padding: 20px; text-align: center; }
        .card-header h2 { margin: 0; font-size: 24px; }
        .card-header p { margin: 5px 0 0; font-size: 13px; opacity: 0.9; }
        .card-body { padding: 25px; }
        .info-group { margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #e0e0e0; }
        .info-group:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .info-label { font-size: 12px; color: #7f8c8d; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .info-value { font-size: 16px; color: #2c3e50; font-weight: 600; line-height: 1.4; }
        .magnitude { display: inline-block; background: #e74c3c; color: white; padding: 4px 10px; border-radius: 6px; font-size: 18px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2>Info Gempa Terkini</h2>
            <p>Sumber Data: API INDONESIA</p>
        </div>
        
        <div class="card-body">
            @if($gempa)
                <div class="info-group">
                    <div class="info-label">Waktu</div>
                    <div class="info-value">{{ $gempa['tanggal'] ?? '-' }} | {{ $gempa['jam'] ?? '-' }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Kekuatan</div>
                    <div class="info-value"><span class="magnitude">{{ $gempa['magnitude'] ?? '-' }}</span></div>
                </div>
                <div class="info-group">
                    <div class="info-label">Kedalaman & Lokasi</div>
                    <div class="info-value">{{ $gempa['kedalaman'] ?? '-' }} - {{ $gempa['wilayah'] ?? '-' }}</div>
                </div>
            @else
                <div class="info-group">
                    <div class="info-value" style="color: red; text-align: center;">Data gempa tidak tersedia atau API Key belum aktif.</div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>