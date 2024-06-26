<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityImage extends Model
{
    use HasFactory;

    protected $table = 'facility_images';
    protected $guarded = ['id'];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
