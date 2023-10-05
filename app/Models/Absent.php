<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absent extends Model
{
    protected $table = "absents";
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = ["id"];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }
}
