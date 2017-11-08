<?php

use Illuminate\Http\Request;

Route::get('/', function(Request $request) {
   $authors = App\Author::with('category')->where('category_id', '<>', 6)->get()->sortBy('updated_at')->take(11)->groupBy('category_id');
   $poems = App\Poem::with('category', 'author')->get()->sortBy('updated_at')->take(50)->sortBy('position')->groupBy('category_id');

   if (strpos($request->getQueryString(), 'ajax') !== false) {
     return view('lists', ['authors'=>$authors, 'poems'=>$poems]);
   }
   $contests = \App\Contest::all();
   return view('welcome', ['authors'=>$authors, 'poems'=>$poems, 'page'=>'welcome', 'contests'=>$contests]);
})->middleware('data')->name('index');

Route::get('/poem/{id}', function ($id) {
    return \App\Poem::find($id);
});

Route::get('/poems', function (Request $request) {
    $poems = App\Poem::paginate(7);
    $data = ['poems'=>$poems, 'page'=>'poems', 'current'=>$poems->currentPage(), 'pages'=>$poems->lastPage()];
    if (strpos($request->getQueryString(), 'ajax') !== false) {
        return view('poems_list', $data);
    }
    return view('poems', $data);
})->name('poems');

Route::get('/authors', function (Request $request) {
    $authors = App\Author::paginate(12);
    $data = ['authors'=>$authors, 'page'=>'authors', 'current'=>$authors->currentPage(), 'pages'=>$authors->lastPage()];
    if (strpos($request->getQueryString(), 'ajax') !== false) {
        return view('authors_list', $data);
    }
    return view('authors', $data);
})->name('authors');


