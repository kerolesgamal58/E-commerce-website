<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $states = State::with(['city', 'country'])->get();
        return view('admin.state.showall', compact('states'));
    }

    public function create(){
        return view('admin.state.create');
    }

    public function store(StateRequest $request){
        State::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
        ]);

        return redirect()->route('state.showstates');
    }

    public function edit($id){
        $state = State::find($id);
        if (!$state)
            return redirect()->route('state.showstates')->with(['error' => 'could not find this state']);
        return view('admin.state.edit', compact('state'));
    }

    public function update(StateRequest $request, $id){
        $state = State::find($id);
        if (!$state)
            return redirect()->route('state.showstates')->with(['error' => 'could not find this state']);
        $data = [
            'name' => $request->name,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
        ];

        State::where('id', $id)->update($data);
        return redirect()->route('state.showstates');
    }

    public function delete($id){
        $state = State::find($id);
        if (!$state)
            return redirect()->back()->with(['error' => 'error']);

        $state->delete();
        return redirect()->route('state.showstates');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $state = State::find($id);
            if (!$state)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $state->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The states is deleted successfully',
        ]);
    }

    public function get_cities(Request $request){
        $cities = City::where('country_id', $request->country_id)->get();
        if (!$cities)
            return response()->json([
                'status' => false,
                'msg' => 'this id ' . $request->country_id . ' is not found',
            ]);
        return response()->json([
            'status' => true,
            'cities' => $cities
        ]);
    }
}
