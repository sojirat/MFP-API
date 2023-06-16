<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'complaint_id'  => 'nullable|integer',
            'status_id'     => 'nullable|integer',
            'search'        => 'nullable|string',
        ]);

        try {
            $complaints = Complaint::query()
                ->when($validated['complaint_id'] ?? null, function ($query, $complaint_id) {
                    return $query->where('id', $complaint_id);
                })
                ->when($validated['status_id'] ?? null, function ($query, $status_id) {
                    return $query->where('status_id', $status_id);
                })
                ->when($validated['search'] ?? null, function ($query, $search) {
                    return $query->where(function ($query) use ($search) {
                        $query->where('title', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
                })
                ->get();

            return res_data($complaints);
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }

    public function create(Request $request)
    {
        try {
            $complaint = new Complaint;

            $complaint->user_id             = Auth::id();
            $complaint->complaint_type_id   = $request->complaint_type_id;
            $complaint->title               = $request->title;
            $complaint->description         = $request->description;
            $complaint->province_id         = $request->province_id;
            $complaint->district_id         = $request->district_id;
            $complaint->sub_district_id     = $request->sub_district_id;
            $complaint->importance          = $request->importance;
            $complaint->status_id           = $request->status_id;
            $complaint->save();

            return res('Complaint created Successfully');
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }

    public function update(Request $request)
    {
        try {
            $complaint = Complaint::findOrFail($request->complaint_id);

            $complaint->complaint_type_id   = $request->complaint_type_id;
            $complaint->title               = $request->title;
            $complaint->description         = $request->description;
            $complaint->province_id         = $request->province_id;
            $complaint->district_id         = $request->district_id;
            $complaint->sub_district_id     = $request->sub_district_id;
            $complaint->importance          = $request->importance;
            $complaint->status_id           = $request->status_id;
            $complaint->save();

            return res('Complaint updated Successfully');
        } catch (\Throwable $th) {
            return res($th, false, 400);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $complaint = Complaint::findOrFail($request->complaint_id);
            $complaint->delete();

            return res('Complaint deleted Successfully');
        } catch (\Throwable $th) {
            return res($th->getMessage(), false, 400);
        }
    }

}
