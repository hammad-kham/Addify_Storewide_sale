<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleRestriction extends Model
{
    protected $fillable = [
        'shopName',
        'sale_type',
        'sale_amount',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'isGuest',
        'user_selection',
        'specific_user_tags',
        'product_selection',
        'specific_products',
        'include_collections',
        'product_tags'
    ];

    //Converts array to comma-separated string
    public function setSpecificProductsAttribute($value)
    {
        $this->attributes['specific_products'] = is_array($value) ? implode(',', $value) : $value;
    }

    //Converts comma-separated string back to array when retrieving
    public function getSpecificProductsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    //specific_user_tags
    public function setSpecificUserTagsAttribute($value)
    {
        $this->attributes['specific_user_tags'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function getSpecificUserTagsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    //include_collections
    public function setIncludeCollectionsAttribute($value)
    {
        $this->attributes['include_collections'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function getIncludeCollectionsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    // product_tags
    public function setProductTagsAttribute($value)
    {
        $this->attributes['product_tags'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function getProductTagsAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    
}
