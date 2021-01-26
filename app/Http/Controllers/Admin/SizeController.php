<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::all();
        return view('admin.size.showall', compact('sizes'));
    }

    public function create(){
        return view('admin.size.create');
    }

    public function store(SizeRequest $request){
        $data = $request->except('_token');

        Size::create($data);

        return redirect()->route('size.showsizes');
    }

    public function edit($id){
        $size = Size::find($id);
        if (!$size)
            return redirect()->route('size.showsizes')->with(['error' => 'could not find this size']);
        return view('admin.size.edit', compact('size'));
    }

    public function update(SizeRequest $request, $id){
        $size = Size::find($id);
        if (!$size)
            return redirect()->route('size.showsizes')->with(['error' => 'could not find this size']);

        $data = $request->except('_token');

        Size::where('id', $id)->update($data);
        return redirect()->route('size.showsizes');
    }

    public function delete($id){
        $size = Size::find($id);
        if (!$size)
            return redirect()->back()->with(['error' => 'error']);

        Storage::delete($size->logo);
        $size->delete();
        return redirect()->route('size.showsizes');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $size = Size::find($id);
            if (!$size)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $size->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The size is deleted successfully',
        ]);
    }
}
