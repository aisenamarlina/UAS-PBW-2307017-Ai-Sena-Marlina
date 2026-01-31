<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Membuka ruang chat dengan user tertentu
     */
    public function index($receiver_id)
    {
        $authId = Auth::id();
        $receiver = User::findOrFail($receiver_id);
        
        // 1. Tandai pesan dari 'receiver' ke 'saya' sebagai sudah dibaca
        Message::where('sender_id', $receiver_id)
            ->where('receiver_id', $authId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // 2. Ambil semua pesan antara kedua user
        $messages = Message::where(function($q) use ($authId, $receiver_id) {
                $q->where('sender_id', $authId)->where('receiver_id', $receiver_id);
            })->orWhere(function($q) use ($authId, $receiver_id) {
                $q->where('sender_id', $receiver_id)->where('receiver_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Gunakan path view yang konsisten
        $viewPath = Auth::user()->role === 'admin' ? 'admin.chat.room' : 'user.chat.room';
        
        return view($viewPath, compact('messages', 'receiver'));
    }

    /**
     * Mengirim pesan (bisa via AJAX atau Form Biasa)
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $msg = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false // Pastikan defaultnya false
        ]);

        // Jika request berasal dari AJAX (seperti di Dashboard)
        if ($request->ajax()) {
            return response()->json([
                'success' => true, 
                'msg' => $msg,
                'sender_name' => Auth::user()->name
            ]);
        }

        // Jika request dari form HTML biasa (seperti di room.blade.php)
        return back()->with('success', 'Pesan terkirim');
    }

    /**
     * Daftar Inbox untuk Admin (Daftar Kontak)
     */
    public function adminInbox()
    {
        $adminId = Auth::id();
        
        // Mengambil user (pelanggan) yang pernah berinteraksi, KECUALI diri sendiri (admin)
        $contacts = User::where('id', '!=', $adminId)
            ->where(function($query) use ($adminId) {
                $query->whereHas('sentMessages', function($q) use ($adminId) {
                    $q->where('receiver_id', $adminId);
                })
                ->orWhereHas('receivedMessages', function($q) use ($adminId) {
                    $q->where('sender_id', $adminId);
                });
            })
            ->withCount(['sentMessages as unread_messages' => function($q) use ($adminId) {
                $q->where('receiver_id', $adminId)->where('is_read', false);
            }])
            ->get();

        return view('admin.chat.index', compact('contacts'));
    }
}