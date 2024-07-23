<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'avatar', 'country_id'];

    /**
     * This will enable to have more countries in the future
     * and to be able to add more fields to the country table
     **/
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeCountryCode($query, string $code): void
    {
        $query->whereHas('country', function ($query) use ($code) {
            $query->where('code', $code);
        });
    }

    public function scopeByTrend($query, string $trend)
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $today = Carbon::today()->toDateString();

        $subQueryYesterday = Comment::selectRaw('COUNT(*)')
            ->whereColumn('comments.user_id', 'users.id')
            ->whereDate('comments.created_at', $yesterday);

        $subQueryToday = Comment::selectRaw('COUNT(*)')
            ->whereColumn('comments.user_id', 'users.id')
            ->whereDate('comments.created_at', $today);

        $query->addSelect([
            'yesterday_count' => $subQueryYesterday,
            'today_count' => $subQueryToday,
        ]);

        return match ($trend) {
            'higher' => $query->havingRaw('today_count > yesterday_count'),
            'lower' => $query->havingRaw('today_count < yesterday_count'),
            'neutral' => $query->havingRaw('today_count = yesterday_count'),
            default => $query,
        };
    }

    public function scopeCustomSort($query, string $field, string $direction): void
    {
        if ($field === 'comments_count') {
            $query->withCount(['comments' => function ($query) {
                $query->whereDate('created_at', today());
            }])->orderBy('comments_count', $direction);
        } else {
            $query->orderBy($field, $direction);
        }
    }

    public function getCommentsTodayCountAttribute(): int
    {
        return $this->comments->where('created_at', '>=', now()->startOfDay())->count();
    }

    public function getCommentsYesterdayCountAttribute(): int
    {
        return $this->comments->where('created_at', '>=', now()->subDay()->startOfDay())
            ->where('created_at', '<', now()->startOfDay())
            ->count();
    }
}
