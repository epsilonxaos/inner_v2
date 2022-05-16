<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 5000) -> create() -> each(
            function($user) {
                factory('App\Customer')->create(['id_user' => $user -> id, 'name' => $user -> name, 'email' => $user -> email]);
            }
        );
    }
}
