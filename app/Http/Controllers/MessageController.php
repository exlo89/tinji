<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Match;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
        $this->middleware('auth:api');
    }

    /**
     * Display the specified resource.
     *
     * @param Match $match
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getMessages(Match $match)
    {
        /** @var User $user */
        $user = auth('api')->user();
        if ($match->host->id != $user->id && $match->client->id != $user->id) {
            return response()->json(['error' => 'Not your chat'],500);
        }
        return MessageResource::collection($match->messages);
    }
}
