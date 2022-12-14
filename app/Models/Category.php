<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    #protected $table = 'catalog_categories';
    #protected $primaryKey = 'category_id';
    // protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class); 
        //return $this->hasMany(Product::class, 'category_id', 'id');
        //$this->belongsToMany(Product::class, 'role_user', 'category_id', 'product_id');
    }
}
