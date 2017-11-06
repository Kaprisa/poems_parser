<?php

use App\Contest;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = iconv("windows-1251", "UTF-8", file_get_contents('http://www.stihi.ru', false));
        preg_match_all('#<p[^>]+?class\s*?=\s*?(["\'])toptext\1[^>]*?>(.*?)</p>#su', $str, $news);
        foreach ([5, 6, 7] as $index) {
            $text = preg_replace('#(</{0,1}[^>]*?>|\n)#', '', $news[2][$index]);
            preg_match('#href\s*?=\s*?(["\'])([^\1]*?)\1#su', $news[2][$index], $link);
            preg_match('#src\s*?=\s*?(["\'])([^\1]*?)\1#su', $news[2][$index], $image);
            $contest = new Contest();
            $contest->text = $text;
            $contest->image = $image[2];
            $contest->link = $link[2];
            $contest->save();
        }
    }
}
