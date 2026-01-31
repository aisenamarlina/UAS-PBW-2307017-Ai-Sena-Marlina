<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat dengan Admin - Creating LC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        :root {
            --leather: #451a03;
            --tan: #78350f;
            --ivory: #fdfcfb;
            --gold: #b45309;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f5f4; margin: 0; display: flex; flex-direction: column; height: 100vh; }
        
        /* Header */
        .chat-header { background: var(--leather); color: white; padding: 15px 20px; display: flex; align-items: center; gap: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .chat-header a { color: white; text-decoration: none; }
        .chat-header .admin-info h3 { margin: 0; font-size: 1rem; }
        .chat-header .admin-info p { margin: 0; font-size: 0.75rem; opacity: 0.8; }

        /* Chat Messages Area */
        .messages-container { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 15px; }
        
        .msg { max-width: 80%; padding: 12px 16px; border-radius: 15px; font-size: 0.9rem; line-height: 1.4; position: relative; }
        .msg-user { align-self: flex-end; background: var(--tan); color: white; border-bottom-right-radius: 2px; }
        .msg-admin { align-self: flex-start; background: white; color: var(--leather); border-bottom-left-radius: 2px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .time { font-size: 0.65rem; opacity: 0.7; display: block; margin-top: 5px; text-align: right; }

        /* Input Area */
        .input-area { background: white; padding: 15px 20px; display: flex; gap: 10px; align-items: center; border-top: 1px solid #e7e5e4; }
        .input-area input { flex: 1; border: 1px solid #e7e5e4; padding: 12px 15px; border-radius: 25px; outline: none; transition: 0.3s; }
        .input-area input:focus { border-color: var(--tan); }
        .btn-send { background: var(--tan); color: white; border: none; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; transition: 0.3s; }
        .btn-send:hover { background: var(--leather); transform: scale(1.05); }
    </style>
</head>
<body>

<header class="chat-header">
    <a href="{{ route('dashboard') }}"><i class="fas fa-arrow-left"></i></a>
    <div class="admin-info">
        <h3>Customer Service CLC</h3>
        <p><i class="fas fa-circle" style="color: #10b981; font-size: 8px;"></i> Online</p>
    </div>
</header>

<div class="messages-container" id="chat-box">
    @forelse($messages as $msg)
        <div class="msg {{ $msg->sender_id == auth()->id() ? 'msg-user' : 'msg-admin' }}">
            {{ $msg->message }}
            <span class="time">{{ $msg->created_at->format('H:i') }}</span>
        </div>
    @empty
        <div style="text-align: center; color: #a8a29e; margin-top: 50px;">
            <i class="fas fa-comments fa-3x" style="opacity: 0.2; margin-bottom: 10px;"></i>
            <p>Halo! Ada yang bisa kami bantu mengenai produk kulit kami?</p>
        </div>
    @endforelse
</div>

<form class="input-area" action="{{ route('chats.store') }}" method="POST">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
    <input type="text" name="message" placeholder="Tulis pesan..." required autocomplete="off">
    <button type="submit" class="btn-send">
        <i class="fas fa-paper-plane"></i>
    </button>
</form>

<script>
    // Scroll otomatis ke bawah saat halaman dimuat
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

</body>
</html>