<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('admins')->delete();
        $adminRecords = [
            [
                'id'=>1,'name'=>'admin','type'=>'admin','email'=>'admin@admin.com','password'=>'$2y$10$N2ih8KMTTe8TbvnsLs4Gw.r5h3vGUw7R4cbhZXErfpvroRnVGNdl2','image'=>'','status'=>1
            ],
            [
                'id'=>2,'name'=>'just','type'=>'subadmin','email'=>'sub@admin.com','password'=>'$2y$10$N2ih8KMTTe8TbvnsLs4Gw.r5h3vGUw7R4cbhZXErfpvroRnVGNdl2','image'=>'','status'=>1
            ],
          ];

          DB::table('admins')->insert($adminRecords);
    }
}
