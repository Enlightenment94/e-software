<?php

require_once ('../public/la-config.php');

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('index');
});

Route::get('/articles', function () {
    return view('articles');
});

Route::get('/afo', function () {
    return view('afo');
});

Route::get('/persons', function () {
    return view('persons');
});

Route::get('/books', function () {
    return view('books');
});

Route::get('/compounds', function () {
    return view('compounds');
});

Route::get('/panel', function () {
    return view('panel');
});



Route::get('/db-afo', function () {
    $tableScript = '../db/db-afo.sql';
    execSqlFile($tableScript);
});

Route::get('/db-persons', function () {
    $tableScript = '../db/db-persons.sql';
    execSqlFile($tableScript);
});

Route::get('/db-books', function () {
    $tableScript = '../db/db-books.sql';
    execSqlFile($tableScript);
});

Route::get('/db-compounds', function () {
    $tableScript = '../db/db-compounds.sql';
    execSqlFile($tableScript);
});

Route::get('/db-articles', function () {
    $tableScript = '../db/db-articles.sql';
    execSqlFile($tableScript);
});



Route::get('/db-tag', function (Illuminate\Http\Request $request) {
    $tag = $request->query('tg');
    insertTag($tag);
});

Route::get('/e-tag', function (Illuminate\Http\Request $request) {
    $id = $request->query('tg-nr');
    $tag = $request->query('tg');
    updateTagById($id, $tag);
});

Route::get('/d-tag', function (Illuminate\Http\Request $request) {
    $id = $request->query('tg-nr');
    deleteTagById($id);
});

Route::get('/i-rec', function (Illuminate\Http\Request $request) {
    $selectedTags = $request->input('tags');
    if(count($selectedTags) < 1){

    }else{
        $title = $request->input('t');
        $subtitle = $request->input('st');
        $description = $request->input('d');

        $arrTagsIds = array();
        $temp = "";
        foreach($selectedTags as $el){
            $temp = selectIdByTag($el);
            array_push($arrTagsIds, $temp);
        }
        $id = insertPost($title, $subtitle, $description);
        //echo "ID: " . $id . "</br>";
        addPostTags($id, $arrTagsIds);
    }
});

Route::get('/e-rec', function (Illuminate\Http\Request $request) {
    $selectedTags = $request->input('tags');
    if(count($selectedTags) < 1){

    }else{
        $id = $request->input('nr');
        $title = $request->input('t');
        $subtitle = $request->input('st');
        $description = $request->input('d');

        $arrTagsIds = array();
        $temp = "";
        foreach($selectedTags as $el){
            $temp = selectIdByTag($el);
            array_push($arrTagsIds, $temp);
        }
        editPost($id, $title, $subtitle, $description);
        deleteAllPostTags($id);
        addPostTags($id, $arrTagsIds);
    }
});

Route::get('/logout', function (Illuminate\Http\Request $request) {
    session_start();
    session_destroy();
    header('Location: index.php');
    exit;    
});

/*
Route::get('/db-post', function () {
    $title = "Post1";
    $subtitle = "subtitle1";
    $post = "Post text 1.";
    insertPost($title, $subtitle, $post);
});


Route::get('/db-sel-posts', function () {
    $arr = selcetTable("posts");
    foreach($arr as $el){
        echo $el['id']. " " . $el['title'] . " " .  $el['subtitle']. " " . $el['description'] . "</br>";
    }

});

Route::get('/db-sel-tags', function () {
    $arr = selcetTable("tags");
    foreach($arr as $el){
        echo $el['id']. " " . $el['name'] . "</br>";
    }
});
*/