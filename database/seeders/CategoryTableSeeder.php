<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Only seed if table is empty
        if (DB::table('category')->count() == 0) {
            DB::table('category')->insert(array(
                ['name'=>'อะไหล่'],
                ['name'=>'เครื่องแต่งกาย'],
                ['name'=>'รองเท้า'],
                ['name'=>'แว่นตา'],
                ['name'=>'อุปกรณ์เสริม'],
                ['name'=>'อิเล็กทรอนิกส์'],
            ));
            echo "Categories seeded successfully.\n";
        } else {
            echo "Categories table already has data, skipping seed.\n";
        }
    }
}
