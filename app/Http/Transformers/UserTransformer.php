<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;
use App\Models\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'            => $user->id,
            'username'      => $user->name,
            'email'         => $user->email,
            'created_at'    => Carbon::parse($user->created_at)->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::parse($user->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
