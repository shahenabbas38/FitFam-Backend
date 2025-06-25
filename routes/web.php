<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/check-weight', function () {
    return Schema::hasColumn('profiles', 'weight') ? '✔ موجود' : '❌ غير موجود';
});
