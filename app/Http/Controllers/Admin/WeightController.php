<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeightRequest;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeightController extends Controller
{
    public function index(){
        $weights = Weight::all();
        return view('admin.weight.showall', compact('weights'));
    }

    public function create(){
        return view('admin.weight.create');
    }

    public function store(WeightRequest $request){
        $data = $request->except('_token');

        Weight::create($data);

        return redirect()->route('weight.showweights');
    }

    public function edit($id){
        $weight = Weight::find($id);
        if (!$weight)
            return redirect()->route('weight.showweights')->with(['error' => 'could not find this weight']);
        return view('admin.weight.edit', compact('weight'));
    }

    public function update(WeightRequest $request, $id){
        $weight = Weight::find($id);
        if (!$weight)
            return redirect()->route('weight.showweights')->with(['error' => 'could not find this weight']);

        $data = $request->except('_token');

        Weight::where('id', $id)->update($data);
        return redirect()->route('weight.showweights');
    }

    public function delete($id){
        $weight = Weight::find($id);
        if (!$weight)
            return redirect()->route('weight.showweights')->with(['error' => 'error']);

        Storage::delete($weight->logo);
        $weight->delete();
        return redirect()->route('weight.showweights');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $weight = Weight::find($id);
            if (!$weight)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $weight->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The weight is deleted successfully',
        ]);
    }
}
