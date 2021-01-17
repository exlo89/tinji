<?php

namespace App\Http\Resources;

use App\Models\TinjiMatch;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources\v3\App
 * @mixin TinjiMatch
 */
class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'host' => UserResource::make($this->host),
            'client' => UserResource::make($this->client),
            'last_message' => $this->last_message,
        ];
    }
}
