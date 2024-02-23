<?php
//routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrafficLogController;

Route::get('/', [TrafficLogController::class, 'index']);
Route::post('/log', [TrafficLogController::class, 'logTraffic'])->name('log.traffic');
