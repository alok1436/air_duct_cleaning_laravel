<?php

namespace App\Http\Controllers\Api;
use App\Models\AirDuct;
use App\Models\DryerVent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing
     */
    public function index()
    {
        try {  
            $data= [];
            $data['airDucts'] = AirDuct::orderBy('created_at','desc')->get();
            $data['dryerVent'] = DryerVent::orderBy('created_at','desc')->get();
            $data['exitPoints'] = [
                "ZEROTOTENFEET"=>"0-10 Feet Off the Ground",
                "TENPLUSFEET"=>"10+ Feet Off the Ground",
                "ROOFTOP"=>"Rooftop"
            ];

            $data['numFurnaces'] = [
                "ONE"=>"1",
                "TWO"=>"2",
                "THREEPLUS"=>"3+"
            ];
            return response()->json($data);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }


    public function calculate(Request $request)
    {
        try {  
            $data = AirDuct::where('square_footage_max','>=', $request->space)->first();
            return response()->json($data);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            return response()->json(['status' => false,'message' => $th->getMessage()], 500);
        }
    }
}
