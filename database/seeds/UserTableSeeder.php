<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
   /**
	* Run the database seeds.
	*
	* @return void
	*/
   public function run()
   {
	   $roleAdmin = Role::where('name', 'admin')->first();
	   $roleUser  = Role::where('name', 'user')->first();
	   $roleEditor = Role::where('name', 'editor')->first();

	   $employee = new User();
	   $employee->name = 'Editor Name';
	   $employee->email = 'editor@example.com';
	   $employee->password = bcrypt('123456');
	   $employee->image = 'image';
	   $employee->phone_number = '0000000000';
	   $employee->address = 'address';
	   $employee->save();
	   $employee->roles()->attach($roleAdmin);

	   $saler = new User();
	   $saler->name = 'User Name';
	   $saler->email = 'user@example.com';
	   $saler->password = bcrypt('123456');
	   $saler->image = 'image';
	   $saler->phone_number = '0000000000';
	   $saler->address = 'address';
	   $saler->save();
	   $saler->roles()->attach($roleUser);

	   $manager = new User();
	   $manager->name = 'Admin Name';
	   $manager->email = 'admin@example.com';
	   $manager->password = bcrypt('123456');
	   $manager->image = 'image';
	   $manager->phone_number = '0000000000';
	   $manager->address = 'address';
	   $manager->save();
	   $manager->roles()->attach($roleEditor);
   }
}
