<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Administrator S.";
            $user->role = 'ADMIN';
            $user->email = 'admin@example.com';
            $user->password = Hash::make('adminpass');
            $user->save();
        }

        $user = User::where('email', 'staff01@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Editar L.";
            $user->role = 'STAFF';
            $user->email = 'staff01@example.com';
            $user->password = Hash::make('staffpass');
            $user->organization_id = "1";
            $user->save();
        }

        $user = User::where('email', 'staff02@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Anya F.";
            $user->role = 'STAFF';
            $user->email = 'staff02@example.com';
            $user->password = Hash::make('staffpass');
            $user->organization_id = "2";
            $user->save();
        }

        $user = User::where('email', 'staff03@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Ainz G.";
            $user->role = 'STAFF';
            $user->email = 'staff03@example.com';
            $user->password = Hash::make('staffpass');
            $user->organization_id = "3";
            $user->save();
        }

        $user = User::where('email', 'staff04@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Sora S.";
            $user->role = 'STAFF';
            $user->email = 'staff04@example.com';
            $user->password = Hash::make('staffpass');
            $user->organization_id = "4";
            $user->save();
        }

        $user = User::where('email', 'user01@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = "ยูสเซอร์ 01";
            $user->role = 'USER';
            $user->email = 'user01@example.com';
            $user->password = Hash::make('userpass');
            $user->save();
        }

        User::factory(5)->create();
    }
}
