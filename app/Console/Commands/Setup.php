<?php

namespace App\Console\Commands;

use App\Contest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

//    private function load_news() { //меняются не часто, так что пока здесь
//        $str = iconv("windows-1251", "UTF-8", file_get_contents('http://www.stihi.ru', false));
/*        preg_match_all('#<p[^>]+?class\s*?=\s*?(["\'])toptext\1[^>]*?>(.*?)</p>#su', $str, $news);*/
//        foreach ([5, 6, 7] as $index) {
/*            $text = preg_replace('#(</{0,1}[^>]*?>|\n)#', '', $news[2][$index]);*/
//            preg_match('#href\s*?=\s*?(["\'])([^\1]*?)\1#su', $news[2][$index], $link);
//            preg_match('#src\s*?=\s*?(["\'])([^\1]*?)\1#su', $news[2][$index], $image);
//            $contest = new Contest();
//            $contest->text = $text;
//            $contest->image = $image[2];
//            $contest->link = $link[2];
//            $contest->save();
//        }
//    }

    public function handle()
    {
        //shell_exec('npm install');
        //shell_exec('npm run prod');
        //Artisan::call('db:create');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        //$this->load_news();
    }
}
