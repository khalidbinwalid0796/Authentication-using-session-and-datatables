<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id', 'name', 'email', 'mobile_no', 'avatar', 'district_id', 'upazila_id',
        'postal_code', 'address', 'password', 'status',
    ];

    //mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    //relation
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function district()
    {
        return $this->belongsTo(Location::class, 'district_id', 'id');
    }
    public function upazila()
    {
        return $this->belongsTo(Location::class, 'upazila_id', 'id');
    }

    private $order = array('employees.id' => 'desc'); //first data load hobe desc order a

    //function define for search 
    private $column_order;

    private $name;
    private $email;
    private $mobile_no;
    private $role_id;
    private $district_id;
    private $upazila_id;
    private $status;

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setMobileNo($mobile_no)
    {
        $this->mobile_no = $mobile_no;
    }
    public function setRoleID($role_id)
    {
        $this->role_id = $role_id;
    }
    public function setDistrictID($district_id)
    {
        $this->district_id = $district_id;
    }
    public function setUpazilaID($upazila_id)
    {
        $this->upazila_id = $upazila_id;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

//function define for search  end

    private $orderValue;
    private $dirValue;
    private $startVlaue;
    private $lengthVlaue;

    public function setOrderValue($orderValue)
    {
        $this->orderValue = $orderValue;
    }
    public function setDirValue($dirValue)
    {
        $this->dirValue = $dirValue;
    }
    public function setStartValue($startVlaue)
    {
        $this->startVlaue = $startVlaue;
    }
    public function setLengthValue($lengthVlaue)
    {
        $this->lengthVlaue = $lengthVlaue;
    }

    private function get_datatable_query()
    {
        //array define for column sorting
        $this->column_order = ['','employees.id', '', 'employees.name', 'employees.role_id', 'employees.email', 'employees.mobile_no',
            'employees.district_id', 'employees.upazila_id', 'employees.postal_code', 'employees.email_verified_at', 'employees.status', ''];

        $query = self::with(['role:id,role_name', 'district:id,location_name', 'upazila:id,location_name']);
        /*****************
         * *Search Query **
         ******************/
        if (!empty($this->name)) {
            $query->where('employees.name', 'like', '%' . $this->name . '%');
        }
        if (!empty($this->email)) {
            $query->where('employees.email', 'like', '%' . $this->email . '%');
        }
        if (!empty($this->mobile_no)) {
            $query->where('employees.mobile_no', 'like', '%' . $this->mobile_no . '%');
        }
        if (!empty($this->role_id)) {
            $query->where('employees.role_id', $this->role_id);
        }
        if (!empty($this->district_id)) {
            $query->where('employees.district_id', $this->district_id);
        }
        if (!empty($this->upazila_id)) {
            $query->where('employees.upazila_id', $this->upazila_id);
        }
        if (!empty($this->status)) {
            $query->where('employees.status', $this->status);
        }
        if (isset($this->orderValue) && isset($this->dirValue)) {
            //column sorting
            $query->orderBy($this->column_order[$this->orderValue], $this->dirValue);//key,value
        } else if (isset($this->order)) {
            //by default desc order a sort hobe
            $query->orderBy(key($this->order), $this->order[key($this->order)]);//key,value
        }
        return $query;
    }

    public function getList()
    {
        $query = $this->get_datatable_query();
        if ($this->lengthVlaue != -1) {
            $query->offset($this->startVlaue)->limit($this->lengthVlaue);
        }
        return $query->get();
    }

    //data search/filter ar somoy ai method call hobe
    public function count_filtered()
    {
        $query = $this->get_datatable_query();
        return $query->get()->count();
    }
    //toBase()->model venge row query te convert kore ty onek first hoy but relation ar somoy kaj kore na
    public function count_all()
    {
        return self::toBase()->get()->count();
    }

}
