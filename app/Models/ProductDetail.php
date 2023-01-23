<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = [
        'deleted_at',
    ];
    protected $fillable = [
        'product_id','description', 'features', 'image_url','created_at','updated_at'
    ];

    public function product(){
        return $this->hasone(Product::class,'product_id','id');
    }

}
