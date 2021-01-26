<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MallRequest;
use App\Models\Mall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MallController extends Controller
{
    public function index(){
        $malls = Mall::all();
        return view('admin.mall.showall', compact('malls'));
    }

    public function create(){
        return view('admin.mall.create');
    }

    public function store(MallRequest $request){
        $data = $request->except(['_token', 'logo']);
        if ($request->has('logo'))
        {
            $path = $request->file('logo')->store('images/mall');
            $data = array_merge($data, ['logo' => $path]);
        }

        Mall::create($data);

        return redirect()->route('mall.showmalls');
    }

    public function edit($id){
        $mall = Mall::find($id);
        if (!$mall)
            return redirect()->route('mall.showmalls')->with(['error' => 'could not find this mall']);
        return view('admin.mall.edit', compact('mall'));
    }

    public function update(MallRequest $request, $id){
        $mall = Mall::find($id);
        if (!$mall)
            return redirect()->route('mall.showmalls')->with(['error' => 'could not find this mall']);

        $data = $request->except(['_token', 'logo']);
        if ($request->has('logo'))
        {
            if (!is_null($mall->logo))
                Storage::delete($mall->logo);
            $path = $request->file('logo')->store('images/mall');
            $data = array_merge($data, ['logo' => $path]);
        }

        Mall::where('id', $id)->update($data);
        return redirect()->route('mall.showmalls');
    }

    public function delete($id){
        $mall = Mall::find($id);
        if (!$mall)
            return redirect()->back()->with(['error' => 'error']);

        Storage::delete($mall->logo);
        $mall->delete();
        return redirect()->route('mall.showmalls');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $mall = Mall::find($id);
            if (!$mall)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $mall->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The mall is deleted successfully',
        ]);
    }
}
