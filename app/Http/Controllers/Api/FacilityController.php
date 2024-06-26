<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function getAllFacilities(Request $request)
    {
        try {
            $facilities = Facility::with(['images', 'reviews']);

            if ($request->has('search')) {
                $facilities->where('name', 'like', '%' . $request->search . '%');
            }

            if ($request->has('category')) {
                $facilities->where('category', $request->category);
            }

            $facilities = $facilities->get();

            $facilitiesArray = $facilities->map(function ($facility) {
                $facility->rating = $facility->rating;
                return $facility;
            });

            return $this->api_response_success('All facilities fetched successfully', $facilitiesArray->toArray());
        } catch (\Exception $e) {
            return $this->api_response_error('Failed to fetch facilities', [], [$e->getMessage()]);
        }
    }

    public function getDetailFacility($id)
    {
        try {
            $facility = Facility::with(['images', 'reviews.user'])->findOrFail($id);
            $facility->rating = $facility->rating;

            return $this->api_response_success('Facility details fetched successfully', $facility->toArray());
        } catch (\Exception $e) {
            return $this->api_response_error('Failed to fetch facility details', [], [$e->getMessage()]);
        }
    }
}
