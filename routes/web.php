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

Route::get('/', function() {
   $authors = App\Author::with('category')->get()->groupBy('category_id');
   $poems = App\Poem::with('category', 'author')->get()->groupBy('category_id');
   return view('welcome', ['authors'=>$authors, 'poems'=>$poems]);
});

Route::post('/', function () {
    event(new \App\Listeners\UpdateTables());
    $authors = App\Author::with('category')->get()->groupBy('category_id');
    $poems = App\Poem::with('category', 'author')->get()->groupBy('category_id');
    return view('lists', ['authors'=>$authors, 'poems'=>$poems]);
});
