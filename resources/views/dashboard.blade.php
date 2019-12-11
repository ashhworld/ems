@extends('master')
 

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Dashboard</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('dashboard.create') }}"> Add New</a>
                <a class="btn btn-danger" href="{{ '/logout' }}"> logged Out</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <?php //echo "<pre>"; print_r($dashboard); ?>
    <table class="table table-bordered">
        <tr>
            <th>Emp Name</th>
            <th>Department</th>
            <th>Salary</th>
            <th>DOJ</th>
            <th>DOB</th>
            {{-- <th>Role</th> --}}
            {{-- <th>Status</th> --}}
            <th width="280px">Action</th>
        </tr>
        @if(isset($dashboard))
        <?php $i = 0;?>
            @foreach ($dashboard as $key => $employee)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $employee['full_name'] }}</td>
                <td>{{ $employee['department']['name'] }}</td>
                <td>{{ $employee['salary'] }}</td>
                {{-- <td>{{ $employee['role']['name'] }}</td> --}}
                <td>{{ $employee['doj'] }}</td>
                <td>{{ $employee['dob'] }}</td>
                {{-- <td>{{ $employee['status'] }}</td> --}}
                <td>
                    <form action="{{'/dashboard/destroy/'}}{{$employee['id']}}" method="DELETE">
                        <button type="submit" class="btn btn-danger">Delete</a>
                    </form>
                </td>
                <td>
                    <form action="{{'/dashboard/update_status/'}}{{$employee['id']}}" method="POST">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="is_active" value="@if($employee['is_active']) 0 @else 1 @endif">
                        <button type="submit" class="btn @if($employee['is_active']) btn-warning @else btn-info @endif">@if($employee['is_active']) Inactive @else Active @endif</a>
                    </form>
                </td>
                <td>
                    <a class="btn btn-success" href="{{ route('dashboard.show', $employee['id']) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('dashboard.edit', $employee['id']) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        
        @endif
    </table>


    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    1. The count of employees who have joined in this year
                </button>
            </h5>
            </div>
        
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                Answer: {{$current_year_joining}}
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                2. The employees who birthday falls in this month
                </button>
            </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Emp Name</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th>DOJ</th>
                        <th>DOB</th>
                        {{-- <th width="280px">Action</th> --}}
                    </tr>
                    @if(isset($current_months_birthdays))
                    <?php $i = 0;?>
                        @foreach ($current_months_birthdays as $mb_key => $mb_employee)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $mb_employee['full_name'] }}</td>
                            <td>{{ $mb_employee['departments']['name'] }}</td>
                            <td>{{ $mb_employee['salary']['amount'] }}</td>
                            <td>{{ $mb_employee['doj'] }}</td>
                            <td>{{ $mb_employee['dob'] }}</td>
                            
                        </tr>
                        @endforeach
                    
                    @endif
                </table>
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                3. The employee with the 5th highest salary
                </button>
            </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
                <table class="table table-bordered">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Emp Name</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>DOJ</th>
                            <th>DOB</th>
                            {{-- <th width="280px">Action</th> --}}
                        </tr>
                        @if(isset($highest_salary))
                        <?php $i = 0;?>
                            {{-- @foreach ($highest_salary as $hs_key => $hs_employee) --}}
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $highest_salary['full_name'] }}</td>
                                <td>{{ $highest_salary['department_name'] }}</td>
                                <td>{{ $highest_salary['amount'] }}</td>
                                <td>{{ $highest_salary['doj'] }}</td>
                                <td>{{ $highest_salary['dob'] }}</td>
                                
                            </tr>
                            {{-- @endforeach --}}
                        
                        @endif
                    </table>
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                4. The employee count per department
                </button>
            </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <div class="card-body">
                    <table class="table table-bordered">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Department</th>
                                <th>Employee Count</th>
                            </tr>
                            @if(isset($rs_emp_dept))
                            <?php $i = 0;?>
                                @foreach ($rs_emp_dept as $ec_key => $ec_employee)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $ec_employee['department_name'] }}</td>
                                    <td>{{ $ec_employee['user_count'] }}</td>
                                </tr>
                                @endforeach
                            
                            @endif
                        </table>
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFive">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                5. employee with highest salary per department.
                </button>
            </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
            <div class="card-body">
                    <table class="table table-bordered">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Department</th>
                                <th>Employee Name</th>
                                <th>Highest Salary</th>

                            </tr>
                            @if(isset($rs_emp_dept))
                            <?php $i = 0;?>
                                @foreach ($rs_emp_dept as $ec_key => $ec_employee)
                                @if($ec_employee['user_id'] != "")
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $ec_employee['department_name'] }}</td>
                                        <td>{{ $ec_employee['full_name'] }}</td>
                                        <td>{{ $ec_employee['highest_salary'] }}</td>
                                    </tr>
                                @endif
                                @endforeach
                            
                            @endif
                        </table>
            </div>
            </div>
        </div>
    </div>


    {{-- {!! $dashboard->render() !!} --}}


@endsection