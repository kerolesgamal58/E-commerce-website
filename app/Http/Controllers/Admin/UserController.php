<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.user.showall', compact('users'));
    }

    public function index_user(){
        $users = User::where('level', 'user')->get();
        return view('admin.user.showall', compact('users'));
    }

    public function index_company(){
        $users = User::where('level', 'company')->get();
        return view('admin.user.showall', compact('users'));
    }

    public function index_vendor(){
        $users = User::where('level', 'vendor')->get();
        return view('admin.user.showall', compact('users'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(UserRequest $request){
        User::create( $request->except(['_token', 'password_confirmation']) );
        return redirect()->route('user.showusers');
    }

    public function edit($id){
        $user = User::find($id);
        if (!$user)
            return redirect()->route('user.showusers')->with(['error' => 'could not find this user']);
        return view('admin.user.edit', compact('user'));
    }

    public function update(UserRequest $request, $id){
        $user = User::find($id);
        if (!$user)
            return redirect()->route('user.showusers')->with(['error' => 'could not find this user']);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->password !== null){
            $data = array_merge($data, ['password' => Hash::make($request->password)]);
        }
        User::where('id', $id)->update($data);
        return redirect()->route('user.showusers');
    }

    public function delete($id){
        $user = User::find($id);
        if (!$user)
            return redirect()->back()->with(['error' => 'error']);

        $user->delete();
        return redirect()->route('user.showusers');
    }

    public function deleteselected(Request $request){
        if (is_null($request->ids))
            return;

        foreach($request->ids as $id){
            $user = User::find($id);
            if (!$user)
                return response()->json([
                    'status' => false,
                    'msg' => 'this id ' . $id . ' is not found',
                ]);

            $user->delete();
        }
        return response()->json([
            'status' => true,
            'msg' => 'The users is deleted successfully',
        ]);
    }
}
