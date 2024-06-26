<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(FacilityImage::class, 'facility_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(FacilityReview::class, 'facility_id', 'id');
    }
}
