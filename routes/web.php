<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback( function(){
    return redirect("/");
});

Route::middleware("guest")->group(function(){
  Route::get("/login" , [AuthController::class , "createLogin"])->name("login");
  Route::post("/login" , [AuthController::class , "storeLogin"]);
  Route::get("/signup" , [AuthController::class , "createSignup"]);
  Route::post("/signup", [AuthController::class , 'storeSignup']);
});

Route::middleware("auth")->group(function(){
  Route::get("/", [PageController::class , "home"]);
  Route::get("/profil" , [PageController::class ,"profil"]);
  Route::middleware("hasAbsent")->group(function(){
      Route::get("/absent" , [PageController::class ,"absent"]);
      Route::post("/absent" , [PageController::class , "storeAbsent"]);
  });
});
