<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'min:5', 'max:3000'],
        ], [
            'message.required' => 'Please write your feedback message.',
            'message.min'      => 'Please write at least 5 characters.',
            'message.max'      => 'Message is too long (max 3000 characters).',
        ]);

        $data['ip']         = $request->ip();
        $data['user_agent'] = substr((string) $request->userAgent(), 0, 255);
        $data['sent_at']    = now()->format('d M Y, h:i A');

        try {
            Mail::to(config('mail.feedback_to', 'info.egts26@gmail.com'))
                ->send(new FeedbackMail($data));

            return response()->json([
                'message' => 'Thank you! Your feedback has been sent successfully.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Feedback mail failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Could not send feedback right now. Please try again later.',
            ], 500);
        }
    }
}