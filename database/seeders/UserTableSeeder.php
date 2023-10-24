<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(50)->create();

        $user = User::find(1);
        $user->name = "Summer";
        $user->email = "summer@qq.com";
        $user->password = bcrypt("123123");
        $user->is_admin = true;
        $user->save();

        $user = User::find(2);
        $user->name = "Winter";
        $user->email = "winter@qq.com";
        $user->password = bcrypt("123123");
        $user->save();

        $user = User::find(3);
        $user->name = "Spring";
        $user->email = "spring@qq.com";
        $user->password = bcrypt("123123");
        $user->save();

        $user = User::find(4);
        $user->name = "Autumn";
        $user->email = "autumn@qq.com";
        $user->password = bcrypt("123123");
        $user->save();
    }
}
