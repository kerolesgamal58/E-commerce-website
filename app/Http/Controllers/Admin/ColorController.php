<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    public function index(){
        $colors = Color::all();
        return view('admin.color.showall', compact('colors'));
    }

    public function create(){
        return view('admin.color.create');
    }

    public function store(ColorRequest $request){
        $data = $request->except('_token');

        Color::create($data);

        return redirect()->route('color.showcolors');
    }

    public function edit($id){
        $color = Color::find($id);
        if (!$color)
            return redirect()->route('color.showcolors')->with(['error' => 'could not find this color']);
        return view('admin.color.edit', compact('color'));
    }

    public function update(ColorRequest $request, $id){
        $color = Color::find($id);
        if (!$color)
            return redirect()->route('color.showcolors')->with(['error' => 'could not find this color']);

        $data = $request->except(['_token', 'icon']);
        if ($request->has('icon'))
        {
            if (!is_null($color->icon))
                Storage::delete($color->icon);
            $path = $request->file('icon')->store('images/icon/color');
            $data = array_merge($data, ['icon' => $path]);
        }

        Color::where('id', $id)->update($data);
        return redirect()->route('color.showcolors');
    }

    public function delete($id){
        $color = Color::find($id);
        if (!$color)
            return redirect()->back()->with(['error' => 'error']);

        Storage::delete($color->logo);
        $color->delete();
        return redirect()->route('color.showcolors');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $color = Color::find($id);
            if (!$color)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $color->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The color is deleted successfully',
        ]);
    }
}
