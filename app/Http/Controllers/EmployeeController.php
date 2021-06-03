<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
       public  function index(){
         dd( Employee::with('user')->get()??'none');
           return view('employees.index');
       }
       public function show(){}
       public function store(){}
       public function update(){}
       public function delete(){}
}
