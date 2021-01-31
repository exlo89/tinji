<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\TinjiMatch;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MessageController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param TinjiMatch $match
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function fetchMessages(TinjiMatch $match)
    {
        /** @var User $user */
        $user = auth('api')->user();
        if ($match->host->id != $user->id && $match->client->id != $user->id) {
            return response()->json(['error' => 'Not your chat'], 500);
        }
        return MessageResource::collection($match->messages);
    }

    /**
     * Persist message to database
     *
     * @param Request $request
     * @return array|JsonResponse
     */
    public function sendMessage(TinjiMatch $match, Request $request)
    {
        /** @var User $user */
        $user = auth('api')->user();

        if ($match->host->id != $user->id && $match->client->id != $user->id) {
            return response()->json(['error' => 'Not your chat'], 500);
        }

        /** @var Message $message */
        $message = $match->messages()->create([
            'user_id' => $user->id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
