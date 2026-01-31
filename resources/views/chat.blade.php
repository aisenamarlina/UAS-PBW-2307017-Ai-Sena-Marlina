<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat dengan {{ $receiver->name }}</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4a332d;
            --bg-body: #eef1f7;
            --msg-sent: #e2fcd2;
            --msg-received: #ffffff;
            --text-main: #2c3e50;
            --text-muted: #7f8c8d;
        }

        * { box-sizing: border-box; }

        body { 
            background: var(--bg-body); 
            font-family: 'Inter', sans-serif; 
            margin: 0; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            color: var(--text-main);
        }

        .chat-wrapper {
            width: 100%;
            max-width: 500px;
            height: 90vh;
            background: white;
            border-radius: 24px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            margin: 20px;
        }

        /* Header */
        .chat-header {
            background: var(--primary-color);
            padding: 15px 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-back {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .btn-back:hover { background: rgba(255,255,255,0.1); }

        .user-meta { flex: 1; }
        .user-meta .name { display: block; font-weight: 600; font-size: 1.05rem; }
        .user-meta .status { font-size: 0.75rem; color: #4cd137; display: flex; align-items: center; gap: 5px; }
        .user-meta .status::before { content: ''; width: 7px; height: 7px; background: #4cd137; border-radius: 50%; }

        /* Tombol Dashboard di Header (Sisi Kanan) */
        .btn-to-dashboard {
            color: white;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 12px;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-to-dashboard:hover { background: white; color: var(--primary-color); }

        /* Chat Body */
        .chat-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            gap: 12px;
            scroll-behavior: smooth;
        }

        .chat-body::-webkit-scrollbar { width: 4px; }
        .chat-body::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }

        .message-row { display: flex; width: 100%; animation: slideIn 0.3s ease-out; }
        @keyframes slideIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .message-row.sent { justify-content: flex-end; }
        .message-row.received { justify-content: flex-start; }

        .message-bubble {
            max-width: 80%;
            padding: 10px 16px;
            font-size: 0.93rem;
            line-height: 1.5;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        }

        .sent .message-bubble {
            background: var(--msg-sent);
            border-radius: 18px 18px 2px 18px;
        }

        .received .message-bubble {
            background: var(--msg-received);
            border-radius: 18px 18px 18px 2px;
            border: 1px solid #edf2f7;
        }

        .empty-state { margin: auto; text-align: center; color: var(--text-muted); }
        .empty-state i { font-size: 3rem; margin-bottom: 10px; display: block; opacity: 0.3; }

        /* Footer */
        .chat-footer { padding: 15px 20px; background: white; border-top: 1px solid #eee; }
        .input-group {
            display: flex;
            align-items: center;
            background: #f1f3f5;
            padding: 5px 5px 5px 15px;
            border-radius: 30px;
        }

        .input-group input {
            flex: 1;
            border: none;
            background: transparent;
            outline: none;
            padding: 10px 0;
            font-size: 0.95rem;
        }

        .btn-send {
            background: var(--primary-color);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .btn-send:hover { transform: scale(1.05); }
    </style>
</head>
<body>

<div class="chat-wrapper">
    <header class="chat-header">
        <a href="{{ url()->previous() }}" class="btn-back">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div class="user-meta">
            <span class="name">{{ $receiver->name }}</span>
            <span class="status">Online</span>
        </div>
        {{-- TOMBOL KEMBALI KE DASHBOARD --}}
        <a href="{{ route('dashboard') }}" class="btn-to-dashboard">
            <i class="fas fa-columns"></i> Dashboard
        </a>
    </header>

    <main class="chat-body" id="message-container">
        @forelse($messages as $msg)
            <div class="message-row {{ $msg->sender_id == Auth::id() ? 'sent' : 'received' }}">
                <div class="message-bubble">
                    {{ $msg->message }}
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-comments"></i>
                <p>Belum ada pesan.</p>
            </div>
        @endforelse
    </main>

    <footer class="chat-footer">
        <div class="input-group">
            <input type="text" id="msg-input" placeholder="Tulis pesan..." autocomplete="off">
            <button class="btn-send" id="send-button" onclick="send()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </footer>
</div>

<script src="https://js.pusher.com/8.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

<script>
    const container = document.getElementById('message-container');
    const input = document.getElementById('msg-input');
    const sendBtn = document.getElementById('send-button');

    const scrollToBottom = () => { container.scrollTop = container.scrollHeight; };
    window.onload = scrollToBottom;

    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env("PUSHER_APP_KEY") }}',
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true
    });

    window.Echo.private(`chat.{{ Auth::id() }}`)
        .listen('MessageSent', (e) => {
            appendMessage(e.message.message, 'received');
        });

    async function send() {
        const message = input.value.trim();
        if (!message) return;

        input.value = '';
        input.disabled = true;
        sendBtn.disabled = true;

        try {
            const response = await fetch("{{ route('chats.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    receiver_id: "{{ $receiver->id }}",
                    message: message
                })
            });

            if (response.ok) {
                appendMessage(message, 'sent');
                input.disabled = false;
                sendBtn.disabled = false;
                input.focus();
            }
        } catch (error) {
            alert("Gagal mengirim pesan.");
            input.disabled = false;
            sendBtn.disabled = false;
        }
    }

    function appendMessage(text, type) {
        const row = document.createElement('div');
        row.className = `message-row ${type}`;
        row.innerHTML = `<div class="message-bubble">${text}</div>`;
        container.appendChild(row);
        
        const empty = document.querySelector('.empty-state');
        if (empty) empty.remove();
        scrollToBottom();
    }

    input.addEventListener("keypress", (e) => { if (e.key === "Enter") send(); });
</script>

</body>
</html>