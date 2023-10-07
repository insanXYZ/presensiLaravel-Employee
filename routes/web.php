<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Models\Absent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
  Route::post("/logout" , [PageController::class , "logout"]);

  Route::middleware("hasPermission")->group(function(){
    Route::get("/permission" , [PageController::class , "permission"]);
    Route::post("/permission" , [PageController::class , "storePermission"]);    
  });

  Route::middleware("hasAbsent")->group(function(){
    Route::get("/absent" , [PageController::class ,"absent"]);
    Route::post("/absent" , [PageController::class , "storeAbsent"]);

  });

});

Route::get("/dump" , function(){
  $data = optional(User::find(Auth::user()->id)->absent->where("date" , Carbon::now()->toDateString())->first());
        
  if($data) {
      $permission = $data->permission;

      if($permission) {
          return "permission ada";
      } else {
        return "permission tidak ada";
      }
  } else {
    return "tidak ada absen sekarang";
  }
});
