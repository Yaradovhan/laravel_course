<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 * @package App\Entity
 * @property Region $parent
 * @property Region[] $children
 * @property string $name
 */
class Region extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function getAddress(): string
    {
        return ($this->parent ? $this->parent->getAddress() . ', ' : '') . $this->name;
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }
}
