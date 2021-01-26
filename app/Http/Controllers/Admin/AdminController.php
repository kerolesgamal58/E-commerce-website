<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $admins = Admin::all();
        return view('admin.showall', compact('admins'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(AdminRequest $request){
        Admin::create( $request->except(['_token', 'password_confirmation']) );
        return redirect()->route('admin.showadmins');
    }

    public function edit($id){
        $admin = Admin::find($id);
        if (!$admin)
            return redirect()->route('admin.showadmins')->with(['error' => 'could not find this admin']);
        return view('admin.edit', compact('admin'));
    }

    public function update(AdminRequest $request, $id){
        $admin = Admin::find($id);
        if (!$admin)
            return redirect()->route('admin.showadmins')->with(['error' => 'could not find this admin']);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->password !== null){
            $data = array_merge($data, ['password' => Hash::make($request->password)]);
        }
        Admin::where('id', $id)->update($data);
        return redirect()->route('admin.showadmins');
    }

    public function delete($id){
        $admin = Admin::find($id);
        if (!$admin)
            return redirect()->back()->with(['error' => 'error']);

        $admin->delete();
        return redirect()->route('admin.showadmins');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $admin = Admin::find($id);
            if (!$admin)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $admin->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The admins is deleted successfully',
        ]);
    }

}
