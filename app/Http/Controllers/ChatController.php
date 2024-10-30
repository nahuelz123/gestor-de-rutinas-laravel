<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string|max:255']);

        $apiKey = env('OPENAI_API_KEY');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [['role' => 'user', 'content' => $request->message]],
            'max_tokens' => 100,
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true, 'reply' => $response['choices'][0]['message']['content']]);
        }

        return response()->json(['success' => false, 'error' => 'Error al comunicarse con la IA.'], 500);
    }
}
