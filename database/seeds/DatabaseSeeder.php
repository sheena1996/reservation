<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'id'                    =>  '1',
            'email'                 =>  'mac.opps@gmail.com',
            'password'              =>  bcrypt('12345678'),
            'is_admin'              =>  '1',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);

        $faker = Faker::create(); 
        for ($i = 2; $i < 10; $i++) {

            // Create User
            DB::table('users')->insert([
                'id'            => $i,
	            'email'         => $faker->email,
                'password'      => bcrypt('secret'),
                'is_admin'      => '0',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
            // Create Client on corresponding User
            DB::table('clients')->insert([
                'id'            => $i,
                'user_id'       => $i,
	            'first_name'    => $faker->firstName,
	            'last_name'     => $faker->lastName ,
	            'contact_number'=> $faker->phoneNumber,
	            'address'       => $faker->streetAddress.' '.$faker->city.' '.$faker->state,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);

            DB::table('products')->insert([
                'id'      => $i,
                'name'    => $faker->word.' '.$faker->domainWord,
                'sku'     => $faker->unique()->randomNumber($nbDigits = 7, $strict = false),
                'cost'    => $faker->randomFloat($nbMaxDecimals = NULL, $min = 99, $max = 1000) ,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
            
        }
    }
}
