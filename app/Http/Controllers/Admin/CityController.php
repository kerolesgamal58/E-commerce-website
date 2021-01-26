<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::with('country')->get();
        return view('admin.city.showall', compact('cities'));
    }

    public function create(){
        return view('admin.city.create');
    }

    public function store(CityRequest $request){
        City::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('city.showcities');
    }

    public function edit($id){
        $city = City::find($id);
        if (!$city)
            return redirect()->route('city.showcities')->with(['error' => 'could not find this city']);
        return view('admin.city.edit', compact('city'));
    }

    public function update(CityRequest $request, $id){
        $city = City::find($id);
        if (!$city)
            return redirect()->route('city.showcities')->with(['error' => 'could not find this city']);
        $data = [
            'name' => $request->name,
            'country_id' => $request->country_id,
        ];

        City::where('id', $id)->update($data);
        return redirect()->route('city.showcities');
    }

    public function delete($id){
        $city = City::find($id);
        if (!$city)
            return redirect()->back()->with(['error' => 'error']);

        $city->delete();
        return redirect()->route('city.showcities');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $city = City::find($id);
            if (!$city)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $city->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The cities is deleted successfully',
        ]);
    }
}
