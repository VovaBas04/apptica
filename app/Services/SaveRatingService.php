<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;

class SaveRatingService
{
    public function save(Collection $ratings, Category $category):void
    {
        $ratings->each(function ($rating,$date) use ($category){
            $category->ratings()->firstOrCreate([
                'date'=>$date,
                'position'=>$rating
            ]);
        });
    }
}
