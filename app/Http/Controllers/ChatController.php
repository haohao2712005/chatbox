<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function sendChat(Request $request){
        $userMessage = $request->input('input');
        Log::info("User message: ". $userMessage);

        $responses = [
            'hello' => 'Hi! How can I assist you today?',
            'default' => 'Sorry, I did not understand that.'
        ];

        $response = $responses['default'];

        foreach ($responses as $key => $reply) {
            if (stripos($userMessage, $key) !== false) {
                $response = $reply;
                break;
            }
        }
        log::info('Chatbot response: '. $response);
        return response()->json($response);
    }
}


