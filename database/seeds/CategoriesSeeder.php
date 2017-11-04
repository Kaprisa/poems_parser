<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('id'=>'1', 'name'=> 'Произведения месяца'),
            array('id'=>'2', 'name'=> 'Рейтинг'),
            array('id'=>'3', 'name'=> 'Рекомендуемые авторы'),
            array('id'=>'4', 'name'=> 'Авторы приглашают'),
            array('id'=>'5', 'name'=> 'Новинки'),
            array('id'=>'6', 'name'=> 'Нет категории'),
        );
        DB::table('categories')->insert($data);
    }
}
