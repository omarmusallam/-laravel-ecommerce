<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromQuery, WithMapping, WithHeadings
{
    protected $query;

    public function setQuery($query)
    {
        $this->query = $query;
    }
    public function query()
    {
        return $this->query;
    }
    public function map($product): array
    {
        return [
            $product->name,
            $product->category->name,
            $product->store->name,
            $product->price,
            $product->compare_price,
            $product->description,
        ];
    }
    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Store',
            'Price',
            'Compare Price',
            'Description'
        ];
    }
    // public function collection()
    // {
    //     $products = Product::all();
    //     return $products;
    // }
}