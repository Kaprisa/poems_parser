<?php

namespace App\Console\Commands;

use App\Author;
use App\Poem;
use Illuminate\Console\Command;

class LoadData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'load new poems and authors or update existing';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    private function get_page($pathname = '') {
        return iconv("windows-1251", "UTF-8", file_get_contents('http://www.stihi.ru/'.$pathname, false));
    }

    private function author_create_or_update($author_link, $name, $position = null, $category = 6) {
        preg_match('#href\s*?=\s*?(["\'])([^\1]*?)\1#su', $author_link, $id_arr);
        $id = preg_replace('#/avtor/#', '', $id_arr[2]);
        $author = Author::where('identifier', $id)->first();
        if ($author === null) {
            $author = new Author();
            $author->identifier = $id;
            $author->name = $name;
        }
        $author->position = $position;
        $author->category_id = $category;
        $author->save();
        return $author->id;
    }

    public function handle()
    {
        $str = $this->get_page();
        preg_match_all('#<ul[^>]+?type\s*?=\s*?(["\'])square\1[^>]*?>(.*?)</ul>#su', $str, $blocks);
        foreach ([0, 1, 4] as $index) {
            preg_match_all('#<a[^>]+?class\s*?=\s*?(["\'])poemlink\1[^>]*?>(.*?)</a>#su', $blocks[0][$index], $poems);
            preg_match_all('#<a[^>]+?class\s*?=\s*?(["\'])authorlink\1[^>]*?>(.*?)</a>#su', $blocks[0][$index], $authors);
            for ($i = 0 ; $i < count($poems[2]); $i ++) {
                $author_id = $this->author_create_or_update($authors[0][$i], $authors[2][$i]);
                preg_match('#href\s*?=\s*?(["\'])([^\1]*?)\1#su', $poems[0][$i], $id_arr);
                $id = preg_replace('#/editor/#', '', $id_arr[2]);
                $poem = Poem::where('identifier', $id)->first();
                if ($poem === null) {
                    $poem = new Poem();
                    $poem->identifier = $id;
                    $poem->name = $poems[2][$i];
                    $poem->author_id = $author_id;
                    $poem_page = $this->get_page($id);
                    preg_match('#<div[^>]+?class\s*?=\s*?(["\'])text\1[^>]*?>(.*?)</div>#su', $poem_page, $text);
                    $poem->text = preg_replace('#&nbsp;\s?#', '', $text[2]);
                }
                $poem->category_id = $index + 1;
                $poem->position = $i + 1;
                $poem->save();
            }
        }
        foreach ([2, 3] as $index) {
            preg_match_all('#<a[^>]+?class\s*?=\s*?(["\'])recomlink\1[^>]*?>(.*?)</a>#su', $blocks[0][$index], $recoms);
            for ($i = 0 ; $i < count($recoms[2]); $i ++) {
                $this->author_create_or_update($recoms[0][$i], $recoms[2][$i], $i + 1, $index + 1);
            }
        }
    }
}
