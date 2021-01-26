<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    public function index(){
        $countries = Country::all();
        return view('admin.country.showall', compact('countries'));
    }

    public function create(){
        return view('admin.country.create');
    }

    public function store(CountryRequest $request){
        Country::create([
            'name' => $request->name,
            'currency' => $request->currency,
            'mobile' => $request->mobile,
            'code' => $request->code,
            'logo' => $request->file('logo')->store('images/countries'),
        ]);

        return redirect()->route('country.showcountries');
    }

    public function edit($id){
        $country = Country::find($id);
        if (!$country)
            return redirect()->route('country.showcountries')->with(['error' => 'could not find this country']);
        return view('admin.country.edit', compact('country'));
    }

    public function update(CountryRequest $request, $id){
        $country = Country::find($id);
        if (!$country)
            return redirect()->route('country.showcountries')->with(['error' => 'could not find this country']);

        $data = $request->except(['_token', 'logo']);

        if ($request->has('logo')){
            if (!is_null($country->logo))
                Storage::delete($country->logo);
            $data = array_merge($data, [
                'logo' => $request->file('logo')->store('images/countries'),
            ]);
        }

        Country::where('id', $id)->update($data);
        return redirect()->route('country.showcountries');
    }

    public function delete($id){
        $country = Country::find($id);
        if (!$country)
            return redirect()->back()->with(['error' => 'error']);

        Storage::delete($country->logo);
        $country->delete();
        return redirect()->route('country.showcountries');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $country = Country::find($id);
            if (!$country)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $country->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The countries is deleted successfully',
        ]);
    }
}
