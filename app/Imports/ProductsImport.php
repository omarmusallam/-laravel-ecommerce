<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    protected $categories;

    public function __construct()
    {
        $this->categories = Category::pluck('id', 'slug')->toArray();
    }

    protected function createCategory($name)
    {
        $category = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);

        return $category->id;
    }

    protected function getCategoryId($name)
    {
        $slug = Str::slug($name);
        if (array_key_exists($slug, $this->categories)) {
            return $this->categories[$slug];
        }

        $id = $this->createCategory($name);
        $this->categories[$slug] = $id;
        return $id;
    }


    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'slug' => Str::slug($row['name']),
            'description' => $row['description'],
            'category_id' => $this->getCategoryId($row['category']),
            'store_id' => $row['store'],
            'price' => $row['price'],
            'compare_price' => $row['compare_price'],
        ]);
    }
}