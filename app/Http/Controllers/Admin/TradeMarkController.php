<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Http\Requests\TradeMarkRequest;
use App\Models\City;
use App\Models\State;
use App\Models\TradeMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TradeMarkController extends Controller
{
    public function index(){
        $trademarks = TradeMark::all();
        return view('admin.trademark.showall', compact('trademarks'));
    }

    public function create(){
        return view('admin.trademark.create');
    }

    public function store(TradeMarkRequest $request){
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        if ($request->has('logo'))
        {
            $path = $request->file('logo')->store('images/trademark');
            $data = array_merge($data, ['logo' => $path]);
        }
        TradeMark::create($data);

        return redirect()->route('trademark.showtrademarks');
    }

    public function edit($id){
        $trademark = TradeMark::find($id);
        if (!$trademark)
            return redirect()->route('trademark.showtrademarks')->with(['error' => 'could not find this trademark']);
        return view('admin.trademark.edit', compact('trademark'));
    }

    public function update(TradeMarkRequest $request, $id){
        $trademark = TradeMark::find($id);
        if (!$trademark)
            return redirect()->route('trademark.showtrademarks')->with(['error' => 'could not find this trademark']);
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        if ($request->has('logo'))
        {
            $path = $request->file('logo')->store('images/trademark');
            $data = array_merge($data, ['logo' => $path]);
        }

        TradeMark::where('id', $id)->update($data);
        return redirect()->route('trademark.showtrademarks');
    }

    public function delete($id){
        $trademark = TradeMark::find($id);
        if (!$trademark)
            return redirect()->back()->with(['error' => 'error']);

        Storage::delete($trademark->logo);
        $trademark->delete();
        return redirect()->route('trademark.showtrademarks');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $trademark = TradeMark::find($id);
            if (!$trademark)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $trademark->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The states is deleted successfully',
        ]);
    }
}
