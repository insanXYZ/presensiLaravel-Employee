<?php

namespace App\Models;

use App\Models\Absent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class status extends Model
{
protected $keyType = "string";
    public $timestamps = false;

    public function absent(): BelongsTo
    {
        return $this->belongsTo(Absent::class , "absent_id" , "id");
    }

}
