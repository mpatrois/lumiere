<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =
        [
            [
                'name'         => 'admin',
                'email'        => 'admin@admin.fr',
                'password'     => bcrypt('motdepasse')
            ],
        ];
        User::insert($users);
    }
}