<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Support\Collection;

class GetRatingService
{
    public function getData($date):Collection
    {
        $collectionRatings = Rating::with('category')->where('date',$date)->get();
        $resultRatings = collect([]);
        $collectionRatings->each(fn (Rating $rating)=> $resultRatings->put($rating->category->category_name,$rating->position));
        return $resultRatings;
    }
}
