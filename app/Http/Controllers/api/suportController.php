<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class suportController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api')->user();
        $messages = $user->suportMessages;

        if ($messages->count() == 0) {
            return response()->json(['message' => 'No messages found'], 404);
        }

        return response()->json($messages, 200);
    }

    public function send_message(Request $request)
    {
        $user = Auth::guard('api')->user();

        $message = $user->suportMessages()->create([
            'title' => $request->title,
        ]);

        return response()->json($message, 200);
    }
}
