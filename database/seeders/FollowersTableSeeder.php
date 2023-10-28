<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        $followers = $users->slice($user_id);
        $follower_ids = $followers->pluck('id')->toArray();

        $user->follow($follower_ids);

        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
