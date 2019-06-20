<?php

namespace App\Entity\Adverts;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['name', 'slug', 'parent_id'];
    public $timestamps = false;
    protected $table = 'advert_categories';

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id','id');
    }
}
