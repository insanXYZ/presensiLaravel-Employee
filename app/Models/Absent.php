<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Absent as absen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absent extends Model
{
    use HasUuids;
    protected $table = "absents";
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = ["id"];

    public static function createAbsent()
    {
        $data = absen::create([
            "user_id" => Auth::user()->id,
            "in_img" => null,
            "out_img" => null,
            "in_location" => null,
            "out_location" => null,
            "in_time" => null,
            "out_time" => null,
            "date" => Carbon::now()->toDateString(),
        ]);

        return $data;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }

    public function permission(): HasOne
    {
        return $this->hasOne(Permission::class , "absent_id" , "id");
    }
}
