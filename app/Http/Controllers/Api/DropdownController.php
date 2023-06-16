<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Province, District, SubDistrict, ComplaintType, Status};
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function province(Request $request)
    {
        $validated = $request->validate([
            'province_id'   => 'nullable|integer',
            'search'        => 'nullable|string',
        ]);

        try {
            $province = Province::query()->where('active', 1)
                ->when($validated['province_id'] ?? null, function ($query, $province_id) {
                    return $query->where('id', $province_id);
                })
                ->when($validated['search'] ?? null, function ($query, $search) {
                    return $query->where('name', 'like', "%$search%");
                })
                ->get();

            return res_data($province);
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }

    public function district(Request $request)
    {
        $validated = $request->validate([
            'province_id'   => 'nullable|integer',
            'district_id'   => 'nullable|integer',
            'search'        => 'nullable|string',
        ]);

        try {
            $district = District::query()->where('active', 1)
                ->when($validated['province_id'] ?? null, function ($query, $province_id) {
                    return $query->where('province_id', $province_id);
                })
                ->when($validated['district_id'] ?? null, function ($query, $district_id) {
                    return $query->where('id', $district_id);
                })
                ->when($validated['search'] ?? null, function ($query, $search) {
                    return $query->where('name', 'like', "%$search%");
                })
                ->get();

            return res_data($district);
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }

    public function sub_district(Request $request)
    {
        $validated = $request->validate([
            'district_id'   => 'nullable|integer',
            'sub_district'  => 'nullable|integer',
            'search'        => 'nullable|string',
        ]);

        try {
            $sub_district = SubDistrict::query()->where('active', 1)
                ->when($validated['district_id'] ?? null, function ($query, $district_id) {
                    return $query->where('district_id', $district_id);
                })
                ->when($validated['sub_district'] ?? null, function ($query, $sub_district) {
                    return $query->where('id', $sub_district);
                })
                ->when($validated['search'] ?? null, function ($query, $search) {
                    return $query->where('name', 'like', "%$search%")
                                ->orWhere('post_code', 'like', "%$search%");
                })
                ->get();

            return res_data($sub_district);
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }

    public function complaint_type(Request $request)
    {
        $validated = $request->validate([
            'complaint_type_id' => 'nullable|integer',
            'search'            => 'nullable|string',
        ]);

        try {
            $complaint_type = ComplaintType::query()->where('active', 1)
                ->when($validated['complaint_type_id'] ?? null, function ($query, $complaint_type_id) {
                    return $query->where('id', $complaint_type_id);
                })
                ->when($validated['search'] ?? null, function ($query, $search) {
                    return $query->where('complaint_type', 'like', "%$search%");
                })
                ->get();

            return res_data($complaint_type);
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }

    public function status(Request $request)
    {
        $validated = $request->validate([
            'status_id'     => 'nullable|integer',
            'search'        => 'nullable|string',
        ]);

        try {
            $status = Status::query()->where('active', 1)
                ->when($validated['status_id'] ?? null, function ($query, $status_id) {
                    return $query->where('id', $status_id);
                })
                ->when($validated['search'] ?? null, function ($query, $search) {
                    return $query->where('status', 'like', "%$search%");
                })
                ->get();

            return res_data($status);
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }
}
