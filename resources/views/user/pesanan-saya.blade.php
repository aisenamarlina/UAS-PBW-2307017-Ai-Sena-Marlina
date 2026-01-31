<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - CLC LUXE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --leather-dark: #3e2723; --leather-medium: #8b5e3c; --leather-light: #b08d57;
            --cream-bg: #fcfaf8; --white: #ffffff; 
            --success: #2ecc71; --warning: #ffa000;
        }

        body { background: var(--cream-bg); color: #2d241e; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }

        h2 { font-family: 'Playfair Display', serif; font-size: 2.2rem; color: var(--leather-dark); margin-bottom: 30px; }

        /* Order Card */
        .order-card { 
            background: var(--white); border-radius: 20px; padding: 25px; 
            margin-bottom: 25px; border: 1px solid #efeae6; box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: 0.3s;
        }

        .order-header { 
            display: flex; justify-content: space-between; align-items: center; 
            padding-bottom: 15px; border-bottom: 1px solid #fcfaf8; margin-bottom: 20px;
        }

        .order-id { font-weight: 800; color: var(--leather-dark); font-size: 1.1rem; }
        
        /* Tracking Component */
        .tracking-wrapper { margin: 20px 0; padding: 20px; background: #fafafa; border-radius: 15px; }
        
        .tracking-steps { 
            display: flex; justify-content: space-between; position: relative; 
            margin-bottom: 30px; padding-top: 10px;
        }

        .tracking-steps::before {
            content: ''; position: absolute; top: 25px; left: 0; width: 100%; height: 3px;
            background: #e2e8f0; z-index: 1;
        }

        .step { position: relative; z-index: 2; text-align: center; width: 25%; }
        .step-icon { 
            width: 35px; height: 35px; background: #e2e8f0; border-radius: 50%; 
            display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;
            color: white; font-size: 0.9rem; transition: 0.4s;
        }

        .step.active .step-icon { background: var(--leather-medium); box-shadow: 0 0 10px rgba(139, 94, 60, 0.4); }
        .step.completed .step-icon { background: var(--success); }
        
        .step-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: #64748b; }
        .step.active .step-label { color: var(--leather-dark); }

        .progress-line {
            position: absolute; top: 25px; left: 0; height: 3px;
            background: var(--success); z-index: 1; transition: width 0.8s ease;
        }

        .delivery-info { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; }
        .info-box { padding: 15px; border-radius: 12px; border: 1px solid #f0f0f0; }
        .info-box label { display: block; font-size: 0.65rem; text-transform: uppercase; font-weight: 800; color: #a1887f; margin-bottom: 5px; }
        .info-box p { font-size: 0.9rem; font-weight: 600; margin: 0; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
            color: var(--leather-medium); font-weight: 700; font-size: 0.9rem; margin-bottom: 20px;
        }

        /* --- CSS BARU UNTUK MODAL LACAK --- */
        .modal {
            display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); backdrop-filter: blur(5px);
        }
        .modal-content {
            background: var(--white); margin: 10% auto; padding: 30px; border-radius: 20px;
            width: 90%; max-width: 500px; position: relative;
        }
        .close-modal { position: absolute; right: 20px; top: 20px; cursor: pointer; font-size: 1.5rem; color: #888; }
        .resi-number { background: #f8f9fa; padding: 10px; border-radius: 8px; border: 1px dashed var(--leather-light); display: block; margin: 10px 0; font-family: monospace; }
        .timeline { border-left: 2px solid #e2e8f0; margin-left: 20px; padding-left: 20px; }
        .timeline-item { position: relative; margin-bottom: 20px; }
        .timeline-item::before { content: ''; position: absolute; left: -26px; top: 0; width: 10px; height: 10px; border-radius: 50%; background: var(--leather-medium); }
        .timeline-date { font-size: 0.7rem; color: #888; display: block; }
        .timeline-desc { font-size: 0.85rem; font-weight: 600; }
        /* ---------------------------------- */

        @media (max-width: 600px) {
            .delivery-info { grid-template-columns: 1fr; }
            .step-label { font-size: 0.6rem; }
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="/dashboard" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <h2>Pesanan Saya</h2>

        @forelse($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <span class="order-id">#ORD-{{ $order->id }}</span>
                <span style="font-size: 0.85rem; color: #888;">{{ $order->created_at->format('d M Y') }}</span>
            </div>

            <div class="tracking-wrapper">
                <div class="tracking-steps">
                    <div class="progress-line" style="width: 
                        {{ $order->status == 'pending' ? '12.5%' : 
                          ($order->status == 'process' ? '37.5%' : 
                          ($order->status == 'shipped' ? '62.5%' : '100%')) }}">
                    </div>

                    <div class="step {{ in_array($order->status, ['pending', 'process', 'shipped', 'completed']) ? 'completed' : '' }}">
                        <div class="step-icon"><i class="fas fa-receipt"></i></div>
                        <div class="step-label">Diterima</div>
                    </div>
                    <div class="step {{ in_array($order->status, ['process', 'shipped', 'completed']) ? ($order->status == 'process' ? 'active' : 'completed') : '' }}">
                        <div class="step-icon"><i class="fas fa-box"></i></div>
                        <div class="step-label">Diproses</div>
                    </div>
                    <div class="step {{ in_array($order->status, ['shipped', 'completed']) ? ($order->status == 'shipped' ? 'active' : 'completed') : '' }}">
                        <div class="step-icon"><i class="fas fa-truck"></i></div>
                        <div class="step-label">Dikirim</div>
                    </div>
                    <div class="step {{ $order->status == 'completed' ? 'completed' : '' }}">
                        <div class="step-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="step-label">Sampai</div>
                    </div>
                </div>

                <div class="delivery-info">
                    <div class="info-box">
                        <label>Status Saat Ini</label>
                        <p style="color: var(--leather-medium);">
                            <i class="fas fa-info-circle"></i> 
                            @if($order->status == 'pending') Menunggu Pembayaran
                            @elseif($order->status == 'process') Sedang Dikemas
                            @elseif($order->status == 'shipped') Kurir Menuju Lokasi
                            @else Pesanan Selesai
                            @endif
                        </p>
                    </div>
                    <div class="info-box">
                        <label>Estimasi Sampai</label>
                        <p><i class="far fa-calendar-alt"></i> {{ $order->created_at->addDays(3)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                <div style="font-size: 0.9rem;">
                    Total Pembayaran: <strong style="color: var(--leather-dark);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                </div>
                @if($order->status == 'shipped' || $order->status == 'completed')
                    <button onclick="openTrackingModal('{{ $order->tracking_number ?? 'CLC-'.rand(100000,999999) }}')" 
                            class="btn-back" style="background: var(--leather-dark); color: white; padding: 8px 15px; border-radius: 8px; margin:0; border:none; cursor:pointer;">
                        Lacak Resi
                    </button>
                @endif
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 50px;">
            <i class="fas fa-shopping-bag" style="font-size: 3rem; opacity: 0.1; display: block; margin-bottom: 20px;"></i>
            <p style="color: #888;">Belum ada riwayat pesanan.</p>
        </div>
        @endforelse
    </div>

    <div id="trackingModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeTrackingModal()">&times;</span>
            <h3 style="font-family: 'Playfair Display', serif; color: var(--leather-dark);">Detail Pelacakan</h3>
            <p style="font-size: 0.8rem; margin: 0;">Nomor Resi:</p>
            <strong id="resiLabel" class="resi-number">CLC-823746283</strong>

            <div class="timeline">
                <div class="timeline-item">
                    <span class="timeline-date">31 Jan 2026 10:30</span>
                    <span class="timeline-desc">Pesanan sedang dalam perjalanan ke lokasi tujuan (Bandung DC)</span>
                </div>
                <div class="timeline-item">
                    <span class="timeline-date">31 Jan 2026 04:15</span>
                    <span class="timeline-desc">Paket telah berangkat dari transit Jakarta</span>
                </div>
                <div class="timeline-item">
                    <span class="timeline-date">30 Jan 2026 18:00</span>
                    <span class="timeline-desc">Paket telah diserahkan ke kurir (Pick Up)</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTrackingModal(resi) {
            document.getElementById('resiLabel').innerText = resi;
            document.getElementById('trackingModal').style.display = 'block';
        }

        function closeTrackingModal() {
            document.getElementById('trackingModal').style.display = 'none';
        }

        // Tutup modal jika klik di luar box
        window.onclick = function(event) {
            let modal = document.getElementById('trackingModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>