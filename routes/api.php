<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionController;

Route::get('/questions', [QuestionController::class, 'index']);

// Lightweight ping endpoint for keep-alive
Route::get('/ping', function () {
    return response()->json(['status' => 'ok'], 200);
});