<?php

namespace App\ResourceManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeesModel extends Model
{

    use SoftDeletes;
    protected $table = 'employees';
    protected $fillable = [
        'category', 'employeename', 'employee_name_field', 'department', 'jobtitle', 'employeeid', 'contractno', 'nationality', 'nationalid', 'nationalidexp', 'passportno', 'passportnoexp', 'overhead', 'created_by'
    ];
}
