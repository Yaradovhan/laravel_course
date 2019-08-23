<?php

namespace App\Entity\Adverts\Advert;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Value
 * @property int $id
 * @property string $file
 */
class Photo extends Model
{
    public $timestamps = false;
    protected $table = 'advert_advert_photos';
    protected $fillable = ['file'];
}
