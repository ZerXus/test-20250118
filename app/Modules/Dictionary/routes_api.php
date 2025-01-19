<?php

use App\Modules\Dictionary\Controllers\DictionaryTagController;
use Illuminate\Support\Facades\Route;

Route::apiResource('dictionaries/tags', DictionaryTagController::class);
