<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - CLC LUXE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        :root {
            --leather-dark: #451a03;
            --leather-primary: #78350f;
            --ivory: #fdfcfb;
            --gold: #b45309;
            --soft-gray: #e7e5e4;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f1f1f0; 
            margin: 0; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Agar container berada di tengah layar */
        }

        /* Container Chat Lebih Kecil & Ramping */
        .chat-wrapper {
            width: 100%;
            max-width: 450px; /* Batasan lebar agar tidak melebar di desktop */
            height: 85vh; /* Tidak full layar agar terlihat seperti window chat */
            background: white;
            display: flex;
            flex-direction: column;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        /* Header Chat - Lebih Padat */
        .chat-header {
            background: var(--leather-dark);
            color: white;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-meta { display: flex; align-items: center; gap: 10px; }
        .avatar {
            width: 32px; height: 32px; /* Ukuran diperkecil */
            background: var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; font-size: 0.9rem; border: 1.5px solid white;
        }

        .user-info h4 { margin: 0; font-size: 0.95rem; }
        .user-info small { font-size: 0.7rem; opacity: 0.8; }

        /* Area Pesan - Spacing Diperkecil */
        .chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: var(--ivory);
            background-image: radial-gradient(#d6d3d1 0.4px, transparent 0.4px);
            background-size: 15px 15px;
        }

        .message {
            max-width: 75%;
            padding: 8px 12px; /* Padding pesan lebih rapat */
            border-radius: 12px;
            font-size: 0.88rem;
            position: relative;
            line-height: 1.4;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .sent {
            align-self: flex-end;
            background: var(--leather-primary);
            color: white;
            border-bottom-right-radius: 2px;
        }

        .received {
            align-self: flex-start;
            background: white;
            color: #1c1917;
            border-bottom-left-radius: 2px;
            border: 1px solid var(--soft-gray);
        }

        .time {
            font-size: 0.65rem;
            margin-top: 3px;
            display: block;
            text-align: right;
            opacity: 0.7;
        }

        /* Input Bar - Lebih Tipis */
        .input-bar {
            background: white;
            padding: 12px 15px;
            display: flex;
            gap: 10px;
            border-top: 1px solid var(--soft-gray);
            align-items: center;
        }

        input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #d6d3d1;
            border-radius: 20px;
            outline: none;
            font-size: 0.9rem;
            background: #fafafa;
        }

        .btn-send {
            background: var(--leather-primary);
            color: white;
            border: none;
            width: 38px; height: 38px;
            border-radius: 50%;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s;
        }

        .btn-send:hover { background: var(--leather-dark); }
        .back-link { color: white; text-decoration: none; font-size: 1rem; }
    </style>
</head>
<body>

<div class="chat-wrapper">
    <div class="chat-header">
        <div class="user-meta">
            <a href="{{ route('admin.orders') }}" class="back-link"><i class="fas fa-chevron-left"></i></a>
            <div class="avatar">{{ substr($receiver->name, 0, 1) }}</div>
            <div class="user-info">
                <h4>{{ $receiver->name }}</h4>
                <small>Pelanggan CLC LUXE</small>
            </div>
        </div>
        <i class="fas fa-ellipsis-v" style="font-size: 0.9rem; cursor: pointer;"></i>
    </div>

    <div class="chat-container" id="chatBox">
        @foreach($messages as $msg)
            <div class="message {{ $msg->sender_id == Auth::id() ? 'sent' : 'received' }}">
                {{ $msg->message }}
                <span class="time">{{ $msg->created_at->format('H:i') }}</span>
            </div>
        @endforeach
    </div>

    <form id="chatForm" class="input-bar">
        @csrf
        <input type="hidden" id="receiver_id" value="{{ $receiver->id }}">
        <input type="text" id="messageText" placeholder="Ketik pesan..." autocomplete="off" required>
        <button type="submit" class="btn-send"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;

    $('#chatForm').on('submit', function(e) {
        e.preventDefault();
        const msg = $('#messageText').val();
        const receiverId = $('#receiver_id').val();

        $.ajax({
            url: "{{ route('chats.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                receiver_id: receiverId,
                message: msg
            },
            success: function(res) {
                $('#chatBox').append(`
                    <div class="message sent">
                        ${msg}
                        <span class="time">Baru saja</span>
                    </div>
                `);
                $('#messageText').val('');
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    });
</script>

</body>
</html>