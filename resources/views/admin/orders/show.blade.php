<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - Admin CLC LUXE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap');

        :root {
            --deep-leather: #451a03;
            --classic-brown: #78350f;
            --luxury-gold: #b45309;
            --ivory-cream: #fffbeb;
            --soft-white: #fdfcfb;
            --text-main: #1c1917;
            --border-color: #e7e5e4;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f5f5f4; 
            background-image: radial-gradient(#d6d3d1 0.5px, transparent 0.5px);
            background-size: 20px 20px;
            color: var(--text-main); 
            margin: 0; 
            padding: 40px 20px; 
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
        }

        .detail-card {
            background: var(--soft-white);
            border-radius: 8px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        /* Header Mewah */
        .card-header {
            background: var(--deep-leather);
            color: white;
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-family: 'Cinzel', serif;
            margin: 0;
            letter-spacing: 2px;
            font-size: 1.5rem;
        }

        /* Badge Status */
        .status-badge {
            padding: 6px 16px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .badge-pending { background: #d97706; color: white; }
        .badge-shipped { background: #2563eb; color: white; }
        .badge-completed { background: #059669; color: white; }
        .badge-cancelled { background: #dc2626; color: white; }

        .content-body { padding: 40px; }

        /* Informasi Grid */
        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
            border-bottom: 1px double var(--border-color);
            padding-bottom: 30px;
        }

        .label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #78716c;
            letter-spacing: 1.5px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .value {
            font-size: 1.05rem;
            color: var(--classic-brown);
            font-weight: 600;
        }

        /* Tabel Produk */
        .table-title {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: var(--deep-leather);
            border-left: 4px solid var(--luxury-gold);
            padding-left: 15px;
        }

        .luxury-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .luxury-table th {
            background: #f8f7f5;
            text-align: left;
            padding: 15px;
            font-size: 0.8rem;
            text-transform: uppercase;
            border-bottom: 2px solid var(--deep-leather);
        }

        .luxury-table td {
            padding: 20px 15px;
            border-bottom: 1px solid #f5f5f4;
            font-size: 0.95rem;
        }

        .total-row {
            background: var(--ivory-cream);
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--deep-leather);
        }

        /* Footer & Buttons */
        .action-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 40px;
            background: #fcfaf8;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            border: none;
        }

        .btn-back { color: #57534e; background: transparent; border: 1px solid #d6d3d1; }
        .btn-back:hover { background: #f5f5f4; }

        .btn-wa { background: #15803d; color: white; }
        .btn-wa:hover { background: #166534; box-shadow: 0 4px 12px rgba(22,101,52,0.2); }

        .btn-update { background: var(--classic-brown); color: white; }
        .btn-update:hover { background: var(--deep-leather); }

        .status-form {
            display: flex;
            gap: 10px;
            background: white;
            padding: 5px;
            border: 1px solid #d6d3d1;
            border-radius: 6px;
        }

        select {
            border: none;
            padding: 8px 15px;
            font-family: inherit;
            font-weight: 600;
            outline: none;
            background: transparent;
        }

        @media (max-width: 600px) {
            .info-section { grid-template-columns: 1fr; }
            .action-area { flex-direction: column; gap: 20px; }
        }
    </style>
</head>
<body>

<div class="container">
    @if(session('success'))
        <div style="background: #065f46; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 600;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="detail-card">
        <div class="card-header">
            <div>
                <h2>Detail Pesanan</h2>
                <span style="opacity: 0.7; font-size: 0.8rem;">ID Transaksi: #{{ $order->id }}</span>
            </div>
            <span class="status-badge badge-{{ $order->status }}">
                {{ $order->status }}
            </span>
        </div>

        <div class="content-body">
            <div class="info-section">
                <div>
                    <div class="label">Pelanggan</div>
                    <div class="value">{{ $order->customer_name }}</div>
                </div>
                <div>
                    <div class="label">Kontak</div>
                    <div class="value">{{ $order->phone }}</div>
                </div>
                <div style="grid-column: span 2;">
                    <div class="label">Alamat Pengiriman</div>
                    <div class="value" style="line-height: 1.6;">{{ $order->address }}</div>
                </div>
                <div>
                    <div class="label">Metode Pembayaran</div>
                    <div class="value">{{ $order->payment_method }}</div>
                </div>
                <div>
                    <div class="label">Tanggal Pemesanan</div>
                    <div class="value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
            </div>

            <div class="table-title">Daftar Produk</div>
            <table class="luxury-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Harga</th>
                        <th style="text-align: center;">Jumlah</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div style="font-weight: 700; color: var(--deep-leather);">{{ $item->product->name ?? 'Produk' }}</div>
                        </td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right; font-weight: 600;">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right; padding: 25px;">Total Pembayaran</td>
                        <td style="text-align: right; padding: 25px; color: var(--luxury-gold);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="action-area">
            <a href="{{ route('admin.orders') }}" class="btn btn-back">
                <i class="fas fa-chevron-left"></i> Kembali
            </a>

            <div style="display: flex; gap: 15px; align-items: center;">
                <a href="{{ route('chats.index', $order->user_id) }}" class="btn" style="background-color: #78350f; color: white;">
    <i class="fas fa-comments"></i> Hubungi Pelanggan
</a>

                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="status-form">
                    @csrf
                    @method('PATCH')
                    <select name="status">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                    </select>
                    <button type="submit" class="btn btn-update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>