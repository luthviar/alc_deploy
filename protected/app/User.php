<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Personnel;
use App\Employee;
use App\Department;
use App\Unit;
use App\LevelPosition;
use App\StrukturOrganisasi;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',  'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is_admin(){
        return $this->is_admin;
    }

    public function get_level(){
        $personnel = Personnel::where('id_user',$this->id)->first();
        $employee  = Employee::where('id_personnel',$personnel->id)->first();
        $level_position = LevelPosition::find($employee->level_position);
        return $level_position;
    }

    public function get_nama(){
        $personnel = Personnel::where('id_user',$this->id)->first();
        return sprintf(" %s %s ",$personnel->fname,$personnel->lname);
    }

    public function get_photo(){
        $personnel = Personnel::where('id_user',$this->id)->first();
        return $personnel->photo;
    }

    public function get_structure(){
        $personnel = Personnel::where('id_user',$this->id)->first();
        $employee = Employee::where('id_personnel', $personnel->id)->first();
        $struktur = StrukturOrganisasi::find($employee->struktur);
        $department = Department::where('id_department', $struktur->id_department)->first();
        $unit = Unit::where('id_unit', $struktur->id_unit)->first();
        return sprintf(" %s - %s ",$department->nama_departmen,$unit->nama_unit);   
    }

    public function get_join(){
        return \Carbon\Carbon::parse($this->updated_at)->format('M , Y');
    }
}
