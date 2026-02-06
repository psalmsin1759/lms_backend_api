<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            // Identity
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'full_name'  => trim("{$this->first_name} {$this->last_name}"),
            'email'      => $this->email,
            'phone'      => $this->phone,
            'avatar'     => $this->avatar,

           

            // RBAC
            'role' => $this->role, // enum string
            'permissions' => $this->whenLoaded(
                'permissions',
                fn () => $this->permissions->pluck('name')
            ),

            // Status & Security
            'status' => $this->status,
            'email_verified' => (bool) $this->email_verified_at,
            'two_factor_enabled' => (bool) $this->two_factor_enabled,

            // Activity
            'last_login_at' => $this->last_login_at,
            'created_at'    => $this->created_at,
        ];
    }
}
