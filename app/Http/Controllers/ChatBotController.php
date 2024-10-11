<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI;
use OpenAI\Laravel\Facades\OpenAI as FacadesOpenAI;

class ChatBotController extends Controller
{
    public function sendChat(Request $request){
        $prompt = $request->input('input');

        try {
            $result = FacadesOpenAI::completions()->create([
                'model'=>'gpt-3.5-turbo',
            'prompt'=>'hello,word !',
            'max_tokens'=>100,
            ]);
         $response = array_reduce(
            $result->toArray()['choice'],
            fn($carry,$choice)=>$carry.$choice['text'],
         );   
         
         return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error'=>'an error occured please check log'],500);
        }
    }
}
