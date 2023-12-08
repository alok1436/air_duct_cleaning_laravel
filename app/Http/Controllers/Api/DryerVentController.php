<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DryerVent;
use Illuminate\Http\Request;

class DryerVentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {  
            $airDucts = DryerVent::orderBy('created_at','desc')->paginate(10);
            return response()->json(['status' => true,'message' => 'Record synced','data'=>$airDucts]);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {  

            $user = auth('api')->user();
            $dryerVent = new DryerVent();
            $dryerVent->dryer_vent_exit_point = $request->get('dryer_vent_exit_point');
            $dryerVent->price = $request->get('price');
            $dryerVent->created_by = $user->id;
            $dryerVent->save();
            return response()->json(['status' => true,'message' => 'Record has been added.']);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DryerVent $dryerVent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DryerVent $dryerVent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DryerVent $dryerVent)
    {
        try {  

            $user = auth('api')->user();
            $dryerVent->dryer_vent_exit_point = $request->get('dryer_vent_exit_point');
            $dryerVent->price = $request->get('price');
            $dryerVent->updated_by = $user->id;
            $dryerVent->save();
            return response()->json(['status' => true,'message' => 'Record has been updated.']);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DryerVent $dryerVent)
    {
        try {  
            $dryerVent->delete();
            return response()->json(['status' => true,'message' => 'Record has been deleted.']);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }
}
