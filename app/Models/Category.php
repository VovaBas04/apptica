<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $hidden=['created_at','updated_at'];
    public function ratings():HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
