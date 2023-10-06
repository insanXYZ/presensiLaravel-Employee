<?php

namespace App\Models;

use App\Models\status;
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

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }

    public function status(): HasOne
    {
        return $this->hasOne(status::class , "absent_id" , "id");
    }
}
