import './bootstrap'; // ini sudah import laravel-echo & pusher-js
import.meta.glob([
    '../images/**',
    '../fonts/**'
]);

// Tambahkan kode realtime di bawah ini
window.Echo.channel('chat.1')
    .listen('ChatMessage', (e) => {
        console.log(e.chat.message);
        // bisa ditambahkan kode untuk update chatBox DOM
    });
