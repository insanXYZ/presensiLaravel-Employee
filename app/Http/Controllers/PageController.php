<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function home()
    {
        return view("main.home" , [
            "user" => User::with(['absent' => function ($query) {
                $query->latest('date')->with(["permission"]);
            }])->where("id" , Auth::user()->id)->first(),
        ]);
    }
    public function permission()
    {

        return view("main.permission");
    }

    public function storePermission(Request $request)
    {
        $credentials = $request->validate([
            "img" => ["required" ,"image"],
            "status" => ["required"],
            "information" => ["required"]
        ]);

        $credentials["date"] = Carbon::now()->toDateString();

        $exist = User::with(['absent'])->where("id",Auth::user()->id)->first()->absent->where("date" , Carbon::now()->toDateString());

        if(count($exist) == 1) {

            $credentials["absent_id"] = $exist[0]->id;
            $credentials["img"] = $request->file("img")->store("permissionImage");

            Permission::create($credentials);


            return redirect("/")->with("success" , "Perizinan berhasil di kirim");
        } else if(count($exist) == 0) {
            $absent = Absent::createAbsent();

            $credentials["absent_id"] = $absent->id;
            $credentials["img"] = $request->file("img")->store("permissionImage");

            Permission::create($credentials);

            return redirect("/")->with("success" , "Perizinan berhasil di kirim");
        }
    }
    public function profil()
    {
        return view("main.profil");
    }
    public function absent()
    {
        return view("main.absent");
    }

    public function cam($img){
        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $fileName = uniqid() . "." . $image_type;

        return [$fileName , $image_base64];
    }

    public function storeAbsent(Request $request)
    {
        $request->validate([
            "image" => ["required"],
            "location" => ["required"]
        ]);

        $img = $request->image;

        $explode = explode("&" ,$request->location);

        $location = json_encode([
            "latitude" => $explode[0],
            "longitude" => $explode[1],
        ]);

        $data = $this->cam($img);

        $datang = Absent::where("user_id", Auth::user()->id)->where("date", Carbon::now()->toDateString())->first();

        if($datang) {
            $datang->update([
                "out_time" => Carbon::now()->toTimeString(),
                "out_img" => $data[0],
                "out_location" => $location,
            ]);
        } else {
            Absent::create([
                "user_id" => Auth::user()->id,
                "in_img" => $data[0],
                "out_img" => null,
                "in_location" => $location,
                "out_location" => null,
                "in_time" => Carbon::now()->toTimeString(),
                "out_time" => null,
                "date" => Carbon::now()->toDateString(),
            ]);
        }

        Storage::put("presensiImage/" . $data[0], $data[1]);

        return redirect("/")->with("success","Absent successfully");
    }
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function about()
    {
        return view("main.about");
    }
}
