<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AirDuct;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\AirDuctRequest;
class AirDuctController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {  
            $airDucts = AirDuct::orderBy('created_at','desc')->paginate(10);
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AirDuctRequest $request) : JsonResponse
    {
        try {  
            $user = auth('api')->user();
            $airDuct = new AirDuct();
            $airDuct->num_furnace = $request->get('num_furnace');
            $airDuct->square_footage_min = $request->get('square_footage_min');
            $airDuct->square_footage_max = $request->get('square_footage_max');
            $airDuct->furnace_loc_sidebyside = $request->get('furnace_loc_sidebyside');
            $airDuct->furnace_loc_different = $request->get('furnace_loc_different');
            $airDuct->final_price = $request->get('final_price');
            $airDuct->created_by = $user ? $user->id : null;
            $airDuct->save();

            return response()->json(['status' => true,'message' => 'Record has been added.']);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AirDuct $airDuct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AirDuct $airDuct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AirDuctRequest $request, AirDuct $airDuct)
    {
        try {  
            $user = auth('api')->user();
            $airDuct->num_furnace = $request->get('num_furnace');
            $airDuct->square_footage_min = $request->get('square_footage_min');
            $airDuct->square_footage_max = $request->get('square_footage_max');
            $airDuct->furnace_loc_sidebyside = $request->get('furnace_loc_sidebyside');
            $airDuct->furnace_loc_different = $request->get('furnace_loc_different');
            $airDuct->final_price = $request->get('final_price');
            $airDuct->updated_by = $user ? $user->id : null;
            $airDuct->save();

            return response()->json(['status' => true,'message' => 'Record has been updated.']);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AirDuct $airDuct)
    {
        try {  
            $airDuct->delete();
            return response()->json(['status' => true,'message' => 'Record has been deleted.']);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }
}
