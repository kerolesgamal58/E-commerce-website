<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use function App\Helper\delete_department;
use function App\Helper\load_dep;

class DepartmentController extends Controller
{
    public function index(){
        $departments = load_dep();
        return view('admin.department.showall', compact('departments'));
    }

    public function create(){
        return view('admin.department.create');
    }

    public function store(DepartmentRequest $request){
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'description' => $request->description ? $request->description : null,
            'keyword' => $request->keyword ? $request->keyword : null,
        ];
        if ($request->has('logo')){
            $path = $request->file('logo')->store('images/departments');
            $data = array_merge($data, ['logo' => $path]);
        }
        Department::create($data);

        return redirect()->route('department.showdepartments');
    }

    public function edit($id){
        $department = Department::find($id);
        if (!$department)
            return redirect()->route('department.showdepartments')->with(['error' => 'could not find this department']);
        return view('admin.department.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, $id){
        $department = Department::find($id);
        if (!$department)
            return redirect()->route('department.showdepartments')->with(['error' => 'could not find this department']);
        $data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'description' => $request->description ? $request->description : null,
            'keyword' => $request->keyword ? $request->keyword : null,
        ];
        if (!is_null($request->logo)){
            if (!is_null($department->logo))
                Storage::delete($department->logo);
            $path = $request->file('logo')->store('images/departments');
            $data = array_merge($data, ['logo' => $path]);
        }

        Department::where('id', $id)->update($data);
        return redirect()->route('department.showdepartments');
    }

    public function delete($id){
        $department = Department::find($id);
        if (!$department)
            return redirect()->route('department.showdepartments')->with(['error' => 'error']);

        delete_department($id);
        return redirect()->route('department.showdepartments');
    }

}
