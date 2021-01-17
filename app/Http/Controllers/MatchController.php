<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchResource;
use App\Http\Resources\UserResource;
use App\Models\TinjiMatch;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MatchController extends Controller
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
     * @return AnonymousResourceCollection
     */
    public function getUsers()
    {
        return UserResource::collection(User::all()->except(auth('api')->user()->id));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return MatchResource
     */
    public function createMatch(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        /** @var User $authUser */
        $authUser = auth('api')->user();

        /** @var TinjiMatch $match */
        $match = $authUser->hostMatches()->create(['client_id' => $request->user_id]);
        return MatchResource::make($match);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function deleteMatch(Request $request)
    {
        $request->validate([
            'match_id' => 'required|exists:matches,id',
        ]);

        /** @var TinjiMatch $match */
        $match = TinjiMatch::find($request->match_id);

        /** @var User $user */
        $user = auth('api')->user();
        if ($match->host->id != $user->id && $match->client->id != $user->id) {
            return response()->json(['error' => 'Not your chat'], 500);
        }
        $match->delete();
        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @return AnonymousResourceCollection
     */
    public function getMatches()
    {
        /** @var User $user */
        $user = auth('api')->user();
        return MatchResource::collection($user->matches());
    }
}
