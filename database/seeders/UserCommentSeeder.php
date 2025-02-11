<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserCommentSeeder extends Seeder
{
    const MIN_COMMENTS = 3;

    const MAX_COMMENTS = 28;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(30)
            ->create()
            ->each(function (User $user) {
                $this->createCommentsForUser($user);
            });
    }

    private function createCommentsForUser(User $user): void
    {
        $start = now()->subDays(7);
        $end = now();

        $dates = $this->generateDateRange($start, $end);

        foreach ($dates as $date) {
            Comment::factory()->count(rand(self::MIN_COMMENTS, self::MAX_COMMENTS))->create([
                'created_at' => $date,
                'user_id' => $user->id,
            ]);
        }
    }

    private function generateDateRange(Carbon $start, Carbon $end): array
    {
        $dates = [];

        for ($date = $start; $date->lte($end); $date->addDay()) {
            $dates[] = $date->copy();
        }

        return $dates;
    }
}
