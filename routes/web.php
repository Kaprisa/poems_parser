<?php

//Route::get('/', function () {
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "http://stihi.ru");
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_FILETIME, 1);
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    $output = curl_exec($ch);
//    if ($output === FALSE) {
//        echo "cURL Error: " . curl_error($ch);
//    }
//    $info = curl_getinfo($ch);
//    echo 'Took ' . $info['total_time'] . ' seconds for url ' . $info['url'];
//    echo dump($info);
//    curl_close($ch);
//}

use Illuminate\Http\Request;

Route::get('/', function(Request $request) {
   $authors = App\Author::with('category')->where('category_id', '<>', 6)->get()->sortBy('updated_at')->take(11)->groupBy('category_id');
   $poems = App\Poem::with('category', 'author')->get()->sortBy('updated_at')->take(50)->sortBy('position')->groupBy('category_id');
   if (strpos($request->getQueryString(), 'ajax') !== false) {
     return view('lists', ['authors'=>$authors, 'poems'=>$poems]);
   }
   return view('welcome', ['authors'=>$authors, 'poems'=>$poems]);
})->middleware('data');

Route::get('/poem/{id}', function ($id) {
    return \App\Poem::find($id);
});

Route::get('/poems', function () {
    $poems = App\Poem::with('category', 'author')->get();
    return view('poems', ['poems'=>$poems]);
});

Route::get('/authors', function () {
    $authors = App\Author::with('category', 'author')->get();
    return view('authors', ['authors'=>$authors]);
});


