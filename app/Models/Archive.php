<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends BaseModel
{
    use HasFactory;

    use HasFactory;

    protected $guarded = ['id'];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
