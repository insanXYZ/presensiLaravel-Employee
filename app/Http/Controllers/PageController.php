<?php

namespace App\Http\Controllers;

use App\Models\Absent;
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
                $query->latest('date');
            }])->where("id" , Auth::user()->id)->first(),
        ]);
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
                "date" => Carbon::now()->toDateString()
            ]);
        }

        Storage::put($data[0], $data[1]);

        return redirect("/")->with("success","Absent successfully");
    }
}
