<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;
Use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj =new Admin;
        $obj->name ='Admin';
        $obj->email ='admin@gmail.com';
        $obj->phone ='';
        $obj->role_id =0;
        $obj->status =1;
        $obj->lob_id =0;
        $obj->token ='';
        $obj->password = Hash::make('1234');
        $obj->save(); 
    }
}
