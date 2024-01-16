<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PrepareDataService
{
    public function __construct(private readonly string $applicationId,private readonly string $countryId,private readonly string $dateFrom,private readonly string $dateTo,private readonly string $magic)
    {

    }
    private function getData(): Collection
    {
        return collect(Http::get("https://api.apptica.com/package/top_history/$this->applicationId/$this->countryId?date_from=$this->dateFrom&date_to=$this->dateTo&$this->magic")
            ->json()["data"]);
    }
    private function isNewTop(string $date,?int $rate,Collection $resultRating):bool
    {
        return $rate and (!$resultRating->has($date) or $resultRating->get($date) > $rate);
    }
    public function converterFromJsonToCategory(): Collection
    {
        $dataCategory = $this->getData();
        foreach ($dataCategory as $category=>$subcategories) {
            $resultRating = collect([]);
            foreach ($subcategories as $dateRating) {
                foreach ($dateRating as $date=>$rate){
                    if ($this->isNewTop($date,$rate,$resultRating)) {
                        $resultRating->put($date, $rate);
                    }
                }
            }
            $dataCategory->put($category,$resultRating);
        }
        return $dataCategory;
    }

}
