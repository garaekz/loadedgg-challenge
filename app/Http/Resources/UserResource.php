<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'avatar' => $this->avatar,
            'country' => CountryResource::make($this->country),
            'comment_activity' => [
                'comments_today' => $this->comments_today_count,
                'trend' => $this->calculateTrend(),
            ],
            'created_at' => $this->created_at,
        ];
    }

    private function calculateTrend(): string
    {
        if ($this->comments_today_count > $this->comments_yesterday_count) {
            return 'higher';
        }

        if ($this->comments_today_count < $this->comments_yesterday_count) {
            return 'lower';
        }

        return 'neutral';
    }
}
