<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * GET /api/chats/{chat}
     * Menampilkan isi chat
     */
    public function show(Chat $chat, Request $request)
    {
        // Security: user hanya boleh akses chat miliknya
        if ($chat->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $messages = Message::where('chat_id', $chat->id)
            ->orderBy('created_at')
            ->get();

        return response()->json([
            'chat_id' => $chat->id,
            'messages' => $messages,
        ]);
    }

    /**
     * POST /api/messages
     * Mengirim pesan
     */
    public function store(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'message' => 'required|string',
        ]);

        $chat = Chat::findOrFail($request->chat_id);

        if ($chat->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        Message::create([
            'chat_id' => $chat->id,
            'sender' => 'user',
            'message' => $request->message,
        ]);

        return response()->json(['status' => 'ok'], 201);
    }

}
