<?php

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

Route::get('/', function () {
    return view('welcome');
});

Route::post('send',[ChatBotController::class,'sendChat']);
Route::post('send',[ChatController::class,'sendChat']);



Route::get('/test-openai',function(){
    try {
        $result = OpenAI::completions()->create([
            'model'=>'gpt-3.5-turbo',
            'prompt'=>'hello,word !',
            'max_tokens'=>100,
        ]);
        return response()->json($result);
    } catch (Exception $e) {
     return $e->getMessage();
    }
});