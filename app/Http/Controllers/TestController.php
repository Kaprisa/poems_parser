<?php

namespace App\Http\Controllers;

use App\Author;
use App\Page;
use App\Poem;
use Illuminate\Http\Request;

class TestController extends Controller
{
//    private function save_page($link, $str = '') {
//        $page = new Page();
//        if ($str == '') {
//            $str = iconv("windows-1251", "UTF-8", file_get_contents($link, false));
//        }
//        preg_match('#<title>(.*?)</title>#su', $str, $title);
//        preg_match('#<index>(.*?)</index>#su', $str, $content);
//        $page->title = trim(preg_replace('#(</{0,1}title>|/\sСтихи\.ру)#', '', $title[0]));
//        $page->content = $content[0];
//        $page->save();
//        return;
//    }
//
//    public function store_pages(Request $request)
//    {
//        $str = iconv("windows-1251", "UTF-8", file_get_contents('http://www.stihi.ru/', false));
//        $this->save_page('http://www.stihi.ru/', $str);
/*        preg_match('#<div[^>]+?class\s*?=\s*?(["\'])headmenu\1[^>]*?>(.*?)</div>#su', $str, $menu);*/
//        preg_match_all('#href\s*?=\s*?(["\'])([^\1]*?)\1#su', $menu[0], $links);
//        for ($i = 0 ; $i < count($links[0]) - 1; $i ++) {
//            $p = preg_replace('#(href\s*?=|["\'])#', '', $links[0][$i]);
//            $this->save_page($p);
//        }
//        return "Страницы сохранены!";
//    }

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

    public function store() {
        $page = Page::find(1);
        preg_match_all('#<ul[^>]+?type\s*?=\s*?(["\'])square\1[^>]*?>(.*?)</ul>#su', $page->content, $blocks);
        foreach ([0, 1, 4] as $index) {
           preg_match_all('#<a[^>]+?class\s*?=\s*?(["\'])poemlink\1[^>]*?>(.*?)</a>#su', $blocks[0][$index], $poems);
           preg_match_all('#<a[^>]+?class\s*?=\s*?(["\'])authorlink\1[^>]*?>(.*?)</a>#su', $blocks[0][$index], $authors);
           for ($i = 0 ; $i < count($poems[2]); $i ++) {
               $author_id = $this->author_create_or_update($authors[0][$i], $authors[2][$i]);
               $poem = new Poem();
               $poem->name = $poems[2][$i];
               $poem->author_id = $author_id;
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

        return "Данные успешно сохранены!";

    }
}
