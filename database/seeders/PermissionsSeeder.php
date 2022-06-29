<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_lists')->insert([
          ['permission_name' => 'view contact form'],
          ['permission_name' => 'edit contact form'],
          ['permission_name' => 'delete contact form'],
          ['permission_name' => 'view users'],
          ['permission_name' => 'add user'],
          ['permission_name' => 'edit user'],
     ]);
    }
}
