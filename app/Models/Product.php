<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image', 'active', 'category_id'];

    public function getImageAttribute(){
        $image = $this->attributes['image'];

        if($image){
            if(Str::startsWith($image, 'http')){
                    return $image;
            }else{
                if(Storage::exists($image)){
                    return Storage::url($image);
                }
                return 'https://i.pinimg.com/736x/98/b9/52/98b952001792e2b836669abf4d853712.jpg';
            }

        }
        return 'https://i.pinimg.com/736x/98/b9/52/98b952001792e2b836669abf4d853712.jpg';
    }

    public function setImageAttribute($value){
        $this->attributes['image'] = Str::lower($value);
    }
    
    public function category(){
        return $this->belongsTo(Category::class); //return $this->belongsTo('Category::class', 'category_id', 'id');
    }
}
