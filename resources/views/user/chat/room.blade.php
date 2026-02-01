<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat dengan Admin - Creating LC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --leather: #451a03;
            --tan: #78350f;
            --ivory: #fdfcfb;
            --gold: #b45309;
            --bg-chat: #efeae2; /* Warna khas background chat */
        }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #d6d3d1; 
            margin: 0; 
            display: flex; 
            justify-content: center; /* Memposisikan ke tengah */
            height: 100vh; 
        }

        /* Container Utama - Dibuat Kecil */
        .main-chat-wrapper {
            width: 100%;
            max-width: 450px; /* Ukuran maksimal lebar chat */
            background: var(--bg-chat);
            display: flex;
            flex-direction: column;
            height: 100vh;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        /* Header */
        .chat-header { 
            background: var(--leather); 
            color: white; 
            padding: 12px 18px; 
            display: flex; 
            align-items: center; 
            gap: 15px; 
            z-index: 10;
        }
        .chat-header a { color: white; text-decoration: none; font-size: 1.1rem; }
        .chat-header .admin-info h3 { margin: 0; font-size: 0.95rem; font-weight: 600; }
        .chat-header .admin-info p { margin: 0; font-size: 0.7rem; opacity: 0.8; }

        /* Chat Messages Area */
        .messages-container { 
            flex: 1; 
            overflow-y: auto; 
            padding: 15px; 
            display: flex; 
            flex-direction: column; 
            gap: 10px; 
            scrollbar-width: thin;
        }
        
        .msg { 
            max-width: 85%; 
            padding: 10px 14px; 
            border-radius: 12px; 
            font-size: 0.88rem; 
            line-height: 1.4; 
            position: relative;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        .msg-user { 
            align-self: flex-end; 
            background: #dcf8c6; /* Hijau soft khas chat user */
            color: #1f2937; 
            border-top-right-radius: 2px; 
        }
        .msg-admin { 
            align-self: flex-start; 
            background: white; 
            color: var(--leather); 
            border-top-left-radius: 2px; 
        }
        .time { 
            font-size: 0.6rem; 
            opacity: 0.6; 
            display: block; 
            margin-top: 4px; 
            text-align: right; 
        }

        /* Input Area */
        .input-area { 
            background: #f0f0f0; 
            padding: 12px 15px; 
            display: flex; 
            gap: 10px; 
            align-items: center; 
        }
        .input-area input { 
            flex: 1; 
            border: none; 
            padding: 10px 15px; 
            border-radius: 20px; 
            outline: none; 
            font-size: 0.9rem;
        }
        .btn-send { 
            background: var(--tan); 
            color: white; 
            border: none; 
            width: 40px; 
            height: 40px; 
            border-radius: 50%; 
            cursor: pointer; 
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-send:hover { background: var(--leather); }

        @media (max-width: 450px) {
            .main-chat-wrapper { max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="main-chat-wrapper">
    <header class="chat-header">
        <a href="{{ route('dashboard') }}"><i class="fas fa-chevron-left"></i></a>
        <div class="admin-info">
            <h3>Customer Service CLC</h3>
            <p><i class="fas fa-circle" style="color: #10b981; font-size: 7px;"></i> Online</p>
        </div>
    </header>

    <div class="messages-container" id="chat-box">
        @forelse($messages as $msg)
            <div class="msg {{ $msg->sender_id == auth()->id() ? 'msg-user' : 'msg-admin' }}">
                {{ $msg->message }}
                <span class="time">{{ $msg->created_at->format('H:i') }}</span>
            </div>
        @empty
            <div style="text-align: center; color: #a8a29e; margin-top: 50px; padding: 0 20px;">
                <i class="fas fa-comments fa-2x" style="opacity: 0.2; margin-bottom: 10px;"></i>
                <p style="font-size: 0.85rem;">Halo! Ada yang bisa kami bantu mengenai produk kulit kami?</p>
            </div>
        @endforelse
    </div>

    <form class="input-area" action="{{ route('chats.store') }}" method="POST">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
        <input type="text" name="message" placeholder="Tulis pesan..." required autocomplete="off">
        <button type="submit" class="btn-send">
            <i class="fas fa-paper-plane" style="font-size: 0.9rem;"></i>
        </button>
    </form>
</div>

<script>
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

</body>
</html>