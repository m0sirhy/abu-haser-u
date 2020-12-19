<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
           
            'name' => 'admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('pa$$word'),
        ]);

        $user->attachRole('super_admin');
        //
    }
}
