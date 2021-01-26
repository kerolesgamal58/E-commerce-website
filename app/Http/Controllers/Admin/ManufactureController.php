<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManufactRequest;
use App\Models\Manufact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManufactureController extends Controller
{
    public function index(){
        $manufactures = Manufact::all();
        return view('admin.manufacture.showall', compact('manufactures'));
    }

    public function create(){
        return view('admin.manufacture.create');
    }

    public function store(ManufactRequest $request){
        $data = $request->except(['_token', 'logo']);
        if ($request->has('logo'))
        {
            $path = $request->file('logo')->store('images/manufacture');
            $data = array_merge($data, ['logo' => $path]);
        }

        Manufact::create($data);

        return redirect()->route('manufacture.showmanufactures');
    }

    public function edit($id){
        $manufacture = Manufact::find($id);
        if (!$manufacture)
            return redirect()->route('manufacture.showmanufactures')->with(['error' => 'could not find this manufacture']);
        return view('admin.manufacture.edit', compact('manufacture'));
    }

    public function update(ManufactRequest $request, $id){
        $manufacture = Manufact::find($id);
        if (!$manufacture)
            return redirect()->route('manufacture.showmanufactures')->with(['error' => 'could not find this manufacture']);

        $data = $request->except(['_token', 'logo']);
        if ($request->has('logo'))
        {
            if (!is_null($manufacture->logo))
                Storage::delete($manufacture->logo);
            $path = $request->file('logo')->store('images/manufacture');
            $data = array_merge($data, ['logo' => $path]);
        }

        Manufact::where('id', $id)->update($data);
        return redirect()->route('manufacture.showmanufactures');
    }

    public function delete($id){
        $manufacture = Manufact::find($id);
        if (!$manufacture)
            return redirect()->back()->with(['error' => 'error']);

        Storage::delete($manufacture->logo);
        $manufacture->delete();
        return redirect()->route('manufacture.showmanufactures');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $manufacture = Manufact::find($id);
            if (!$manufacture)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $manufacture->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The manufacture is deleted successfully',
        ]);
    }
}
