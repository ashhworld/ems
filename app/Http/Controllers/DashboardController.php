<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Salary;
use App\Departments;
use DB;
use Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        
        $current_months_birthdays = User::with('departments', 'salary')
                            ->select()
                            ->whereMonth('dob', '=', date('m'))
                            ->where('id', "!=", 1)
                            ->get()->toArray();
                            

        $current_year_joining = User::select()
                            ->whereYear('doj', '=', date('Y'))
                            ->where('id', "!=", 1)
                            ->count('id');


        $highest_salary = Salary::select("users.id as user_id", "users.full_name", "salary.amount", "departments.name as department_name", "doj", "dob")
                ->leftJoin('users', 'users.id', '=', 'salary.user_id')
                ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->groupBy('salary.amount')
                ->orderBy('salary.amount', "DESC")
                ->skip(4)->first()->toArray(); 

        $rs_emp_dept = User::select(DB::raw('count(users.id) as user_count'), 
                    DB::raw('group_concat(users.id) as user_ids'), "users.department_id", 
                    "departments.name as department_name")
                ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->groupBy('users.department_id')
                ->orderBy('users.department_id', "DESC")
                ->get()->toArray(); 

        if(!empty($rs_emp_dept)){
            foreach($rs_emp_dept as $key => $rows){
                $query = Salary::select(DB::raw('max(salary.amount) as highest_salary'), 'salary.user_id', "users.full_name")
                        ->leftJoin('users', 'users.id', '=', 'salary.user_id')
                        ->whereIn("salary.user_id", explode(",", $rows['user_ids']))
                        ->first()->toArray();
                        // print_r($query);
                        $rs_emp_dept[$key]["highest_salary"] = $query['highest_salary'];
                        $rs_emp_dept[$key]["user_id"] = $query['user_id'];
                        $rs_emp_dept[$key]["full_name"] = $query['full_name'];
            }
        }

        $data['current_months_birthdays'] = $current_months_birthdays;
        $data['current_year_joining'] = ($current_year_joining);
        $data['highest_salary'] = $highest_salary;
        $data['rs_emp_dept'] = $rs_emp_dept;
        // print_r($data);
        return view('dashboard', $data);
    }

    public function employeeView() {
        $data = array();
        $data['rs_users'] = User::with('departments', 'salary')
                ->select()
                ->orderBy('created_at','desc')
                ->get()->toArray();
        return view('employee_view', $data);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['rs_users'] = User::with('departments', 'salary')
                ->select()
                ->orderBy('created_at','desc')
                ->get()->toArray();
        return view('employee_view', $data);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
