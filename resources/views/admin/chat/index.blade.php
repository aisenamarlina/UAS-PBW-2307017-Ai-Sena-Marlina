<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox Chat - CLC LUXE Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        :root {
            --leather: #451a03;
            --tan: #78350f;
            --ivory: #fdfcfb;
            --gold: #b45309;
            --soft-gray: #e7e5e4;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f1f1f0; 
            margin: 0; 
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Navigasi Kecil */
        .nav-back {
            width: 100%;
            max-width: 380px;
            margin-bottom: 10px;
        }

        .btn-back {
            text-decoration: none;
            color: var(--leather);
            font-weight: 700;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }

        .btn-back:hover { color: var(--gold); }

        /* Wrapper Inbox Kecil */
        .inbox-wrapper {
            width: 100%;
            max-width: 380px; /* Diperkecil sesuai chat window */
            height: 80vh;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            border: 1px solid var(--soft-gray);
        }

        .inbox-header {
            background: var(--leather);
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .inbox-header h3 { 
            margin: 0; 
            font-size: 0.9rem; 
            letter-spacing: 0.5px; 
            text-transform: uppercase;
        }

        /* Daftar Kontak */
        .contact-list { 
            list-style: none; 
            margin: 0; 
            padding: 0; 
            overflow-y: auto;
            flex: 1;
        }

        .contact-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #f5f5f4;
            text-decoration: none;
            color: inherit;
            transition: 0.2s;
        }

        .contact-item:hover { background: #fafaf9; }

        .avatar {
            width: 38px; height: 38px;
            background: var(--gold);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            margin-right: 12px;
            border: 1px solid #fff;
            flex-shrink: 0;
        }

        .contact-info { flex: 1; min-width: 0; }
        .contact-info h4 { 
            margin: 0 0 2px; 
            font-size: 0.85rem; 
            color: var(--leather);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .contact-info p { 
            margin: 0; 
            font-size: 0.75rem; 
            color: #78716c;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-meta { 
            text-align: right; 
            margin-left: 10px;
            flex-shrink: 0;
        }
        .time { font-size: 0.65rem; color: #a8a29e; }
        
        /* Notifikasi Angka Kecil */
        .unread-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gold);
            color: white;
            font-size: 0.6rem;
            font-weight: 800;
            min-width: 16px;
            height: 16px;
            border-radius: 10px;
            padding: 0 4px;
            margin-top: 4px;
        }

        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #a8a29e;
        }
        
        .empty-state i { opacity: 0.2; margin-bottom: 10px; }
        .empty-state p { font-size: 0.8rem; }
    </style>
</head>
<body>

<div class="nav-back">
    <a href="{{ route('admin.dashboard') }}" class="btn-back">
        <i class="fas fa-chevron-left"></i> Kembali ke Dashboard
    </a>
</div>

<div class="inbox-wrapper">
    <div class="inbox-header">
        <i class="fas fa-comments"></i>
        <h3>Pesan Masuk</h3>
    </div>

    <div class="contact-list">
        @forelse($contacts as $contact)
            <a href="{{ route('chats.index', $contact->id) }}" class="contact-item">
                <div class="avatar">{{ substr($contact->name, 0, 1) }}</div>
                <div class="contact-info">
                    <h4>{{ $contact->name }}</h4>
                    <p>Klik untuk melihat percakapan...</p>
                </div>
                <div class="status-meta">
                    <div class="time">Sekarang</div>
                    
                    @php
                        $unreadCount = \App\Models\Message::where('sender_id', $contact->id)
                                    ->where('receiver_id', auth()->id())
                                    ->where('is_read', false)
                                    ->count();
                    @endphp

                    @if($unreadCount > 0)
                        <div class="unread-badge">{{ $unreadCount }}</div>
                    @endif
                </div>
            </a>
        @empty
            <div class="empty-state">
                <i class="fas fa-comment-slash fa-2x"></i>
                <p>Belum ada pesan dari pelanggan.</p>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>