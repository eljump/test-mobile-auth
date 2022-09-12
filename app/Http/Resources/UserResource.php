<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $this->resource;

        return [
            "name" => $user->name,
            "phone" => $user->phone,
        ];
    }
}
