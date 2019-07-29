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
    protected $table = 'advert_advert_values';

    public $timestamps = false;

    protected $fillable = ['attribute_id', 'value'];
}
