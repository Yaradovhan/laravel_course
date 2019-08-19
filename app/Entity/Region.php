<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 * @property int $id
 * @package App\Entity
 * @property Region $parent
 * @property Region[] $children
 * @property string $name
 *
 * @method Builder roots()
 */
class Region extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function getPath(): string
    {
        return ($this->parent ? $this->parent->getPath() . '/' : '') . $this->slug;
    }

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

    public function scopeRoots(Builder $query)
    {
        return $query->where('parent_id', null);
    }
}
