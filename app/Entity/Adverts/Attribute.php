<?php

namespace App\Entity\Adverts;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';
    protected $table = 'advert_attributes';
    public $timestamps = false;
    protected $fillable = ['name', 'type', 'required', 'default', 'variants', 'sort'];

    protected $casts = [
        'variables' => 'array'
    ];

    public static function typesList() :array
    {
        return [
            self::TYPE_FLOAT => 'Float',
            self::TYPE_INTEGER => 'Integer',
            self::TYPE_STRING => 'String'
        ];
    }

    public function isString() :bool
    {
        return $this->type === self::TYPE_STRING;
    }
    public function isFloat() :bool
    {
        return $this->type === self::TYPE_FLOAT;
    }
    public function isInteger() :bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isSelect() :bool
    {
        return \count($this->variants) > 0;
    }
}
