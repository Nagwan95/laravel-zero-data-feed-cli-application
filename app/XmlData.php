<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XmlData extends Model
{
    use HasFactory;

    protected $table = 'xml_data';

    protected $fillable = [
        'entity_id',
        'category_name',
        'sku',
        'name',
        'description',
        'shortdesc',
        'price',
        'link',
        'image',
        'brand',
        'rating',
        'caffeine_type',
        'count',
        'flavored',
        'seasonal',
        'instock',
        'facebook',
        'IsKCup'
    ];
}
