<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function send(Request $request)
    {
        $message = $request->input('message');
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $message],
            ],
        ]);
        $aiResponse = $response->choices[0]->message->content;

        $chatHistory = Session::get('chat_history', []);
        $chatHistory[] = ['role' => 'You', 'message' => $message];
        $chatHistory[] = ['role' => 'AI', 'message' => $aiResponse];
        Session::put('chat_history', $chatHistory);
        
        return response()->json(['response' => $aiResponse]);
    }
}
