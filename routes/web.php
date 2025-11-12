<?php

use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Selamat Datang';
});

Route::get('level', [LevelController::class, 'index']);

Route::get('/hello', function () {
return 'world';
});

Route::get('/about', function () {
return 'NIM = 23.51.0028, Nama = Imelda Nadila';
});

Route::get('/user/{name?}', function ($name = null) {
    if ($name) {
        return 'Hallo Nama Saya ' . $name;
    } else {
        return 'Hallo, Nama Anda Siapa?';
    }
});

Route::get('/kontak', function () {
return view ('kontak');
});




Route::get('/posts/{post}/comments/{comment}', function
($postId, $commentId) {
return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

