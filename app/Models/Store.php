<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'logo_image', 'status', 'slug'
    ];
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';
    // protected $connection = 'mysql';
    // protected $table = 'stores';
    // protected $primaryKey = 'id';
    // protected $keyType = 'int';
    // public $incrementing = true;
    // public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        if ($filters['name'] ?? false) {
            $builder->where('stores.name', 'LIKE', "%{$filters['name']}%");
        }
        if ($filters['status'] ?? false) {
            $builder->where('stores.status', '=', $filters['status']);
        }
    }

    public static function rouls($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:30',
                // 'unique:categories,name,$id',
                Rule::unique('stores', 'name')->ignore($id),
                    // function($attribute, $value, $fails){
                    //     if(strtolower($value) == 'god'){
                    //         $fails('Invalid name!');
                    //     }
                    // }
                new Filter('God'),
            ],
            'logo_image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'status' => 'in:active,inactive',
        ];
    }
}