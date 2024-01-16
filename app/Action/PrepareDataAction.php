<?php

namespace App\Action;

use App\Models\Category;
use App\Services\PrepareDataService;
use App\Services\SaveRatingService;
use Ramsey\Collection\Collection;

class PrepareDataAction
{
    public function __construct(private readonly PrepareDataService $prepareDataService, private readonly SaveRatingService $saveRatingService)
    {

    }
    public function execute():void
    {
        $categories = $this->prepareDataService->converterFromJsonToCategory();
        foreach ($categories as $category => $subcategories) {
            $categoryModel = Category::query()->firstOrCreate([
                'category_name' => $category
            ]);
            $this->saveRatingService->save($subcategories,$categoryModel);
        }
    }
}
