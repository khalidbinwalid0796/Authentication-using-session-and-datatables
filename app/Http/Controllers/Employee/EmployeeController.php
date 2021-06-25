<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Role;
use App\Models\Employee;
use App\Traits\Uploadable;

class EmployeeController extends Controller
{
    //trait use
    use Uploadable;

    public function index()
    {
        $data['roles'] = Role::all();
        $data['districts'] = Location::where('parent_id', 0)->orderBy('location_name', 'asc')->get();
        return view('Employee.index', $data);
    }

    //upazilaList
    public function upazilaList(Request $request){
        //$request->ajax()->check kore request ta ajax theke astese kina
        if ($request->ajax()) {
            $output = '<option value="">Select Please</option>';
            $upazilas = Location::where('parent_id', $request->district_id)->orderBy('location_name', 'asc')->get();
            if (!$upazilas->isEmpty()) {
                foreach ($upazilas as $value) {
                    $output .= '<option value="' . $value->id . '">' . $value->location_name . '</option>';
                }
            }
            return response()->json($output);
        }
    }

    //store
    public function store(Request $request){
        $data = ($request->all());
        $collection = collect($data)->except(['avatar', 'password_confirmation']);
        if ($request->file('avatar')) {
            $avatar = $this->upload_file($request->file('avatar'), USER_AVATAR);
            $collection = $collection->merge(compact('avatar'));
        }
        $result = Employee::Create($collection->all());
        if($result){
            $output = ['status' => 'success', 'message' => 'Data has been saved successfully'];
        }
        return response()->json($output);
    }

    //update
    public function update(Request $request){
        $data = ($request->all());
        $collection = collect($data)->except(['avatar', 'password','password_confirmation']);
        if ($request->file('avatar')) {
            $avatar = $this->upload_file($request->file('avatar'), USER_AVATAR);
            $collection = $collection->merge(compact('avatar'));
            if (!empty($request->old_avatar)) {
                $this->delete_file($request->old_avatar, USER_AVATAR);
            }
        }
        $result = Employee::updateOrCreate(['id' => $request->update_id],$collection->all());
        if($result){
            $output = ['status' => 'success', 'message' => 'Data has been updated successfully'];
        }
        return response()->json($output);
    }

    //edit
    public function edit(Request $request){
        if ($request->ajax()) {
            $data = Employee::toBase()->find($request->id);
            if ($data) {
                //object akare json return korbe
                $output['user'] = $data;
            } else {
                $output['user'] = '';
            }
            return response()->json($output);
        }
    }

    //show-->render() blade file ajax ar sathe use kora jai
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with(['role:id,role_name', 'district:id,location_name',
                'upazila:id,location_name'])->find($request->id);
            if ($data) {
                $output['user_view'] = view('Employee.user_details', compact('data'))->render();
                $output['name'] = $data->name;
            } else {
                $output['user_view'] = '';
                $output['name'] = '';
            }
            return response()->json($output);
        }
    }

    //delete
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::find($request->id);
            if ($data) {
                $avatar = $data->avatar;
                if ($data->delete()) {
                    if (!empty($avatar)) {
                        $this->delete_file($avatar, USER_AVATAR);
                    }
                    $output = ['status' => 'success', 'message' => 'Data deleted successfully'];
                } else {
                    $output = ['status' => 'error', 'message' => 'Data cannot delete!'];
                }
            } else {
                $output = ['status' => 'error', 'message' => 'Data cannot delete!'];
            }
            return response()->json($output);
        }
    }

    //list
    public function userList(Request $request){
        if ($request->ajax()){
            //dd($request->all());
            $user = new Employee();

            //index.blade.php page theke pass kora value gulo dhore method ar maddhome Employee model a pass korlam
            if (!empty($request->name)) {
                $user->setName($request->name);
            }
            if (!empty($request->email)) {
                $user->setEmail($request->email);
            }
            if (!empty($request->mobile_no)) {
                $user->setMobileNo($request->mobile_no);
            }
            if (!empty($request->role_id)) {
                $user->setRoleID($request->role_id);
            }
            if (!empty($request->district_id)) {
                $user->setDistrictID($request->district_id);
            }
            if (!empty($request->upazila_id)) {
                $user->setUpazilaID($request->upazila_id);
            }
            if (!empty($request->status)) {
                $user->setStatus($request->status);
            }

            $user->setOrderValue($request->input('order.0.column'));//select column using this method
            $user->setDirValue($request->input('order.0.dir'));//asc or desc order a selected column sort hobe
            $user->setLengthValue($request->input('length'));//number of data show per page
            $user->setStartValue($request->input('start'));//page ar start value 1-5, 6-10, 11-15

            $list = $user->getList();
            $data = [];
            $no = $request->input('start');
            foreach ($list as $value) {
                $no++;//sl no
                $action = '';
                $action .= ' <a class="dropdown-item edit_data" data-id="' . $value->id . '" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="fas fa-edit text-primary"></i> Edit</a>';
                $action .= ' <a class="dropdown-item view_data"  data-id="' . $value->id . '" data-bs-toggle="modal" data-bs-target="#viewDataModal"><i class="fas fa-eye text-warning"></i> View</a>';
                $action .= ' <a class="dropdown-item delete_data"  data-id="' . $value->id . '" data-name="' . $value->name . '"><i class="fas fa-trash text-danger"></i> Delete</a>';

                $btngroup = '<div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-th-list"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                ' . $action . '
                </div>
              </div>';

              $row = [];
              $row[] = $no;
              $row[] = $this->avatar($value->avatar, $value->name);
              $row[] = $value->name;
              $row[] = $value->role->role_name;
              $row[] = $value->email;
              $row[] = $value->mobile_no;
              $row[] = $value->district->location_name;
              $row[] = $value->upazila->location_name;
              $row[] = $value->postal_code;
              $row[] = $value->email_verified_at ? '<span class="badge badge-pill badge-success">Verified</span>' : '<span class="badge badge-pill badge-danger">Unverified</span>';
              $row[] = STATUS[$value->status];
              $row[] = $btngroup;
              $data[] = $row;

            }
            $output = array(
                "draw" => $request->input('draw'),//request theke ase
                "recordsTotal" => $user->count_all(),
                "recordsFiltered" => $user->count_filtered(),
                "data" => $data,
            );

            echo json_encode($output);
        } 
    }

    private function avatar($avatar, $name)
    {
        return !empty($avatar) ? '<img src="' . asset("storage/" . USER_AVATAR . $avatar) . '" alt="' . $name . '" style="width:60px;"/>' : '<img style="width:60px;" src="' . asset("") . '" alt="User Avatar"/>';
    }

}
