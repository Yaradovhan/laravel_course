<?php

namespace App\Entity\Adverts\Advert;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Value
 * @package App\Entity\Adverts\Advert
 * @property int $attribute_id
 * @property string $value
 */
class Value extends Model
{
    public $timestamps = false;
    protected $table = 'advert_advert_values';
    protected $fillable = ['attribute_id', 'value'];
}
