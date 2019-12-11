@extends('master')
 

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Dashboard</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('dashboard.index') }}"> Add New</a>
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
            <th>Sr. No.</th>
            <th>Emp Name</th>
            <th>Department</th>
            <th>Salary</th>
            <th>DOJ</th>
            <th>DOB</th>
            <th width="280px">Action</th>
        </tr>
        @if(isset($rs_users))
        <?php $i = 0;?>
            @foreach ($rs_users as $key => $employee)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $employee['full_name'] }}</td>
                <td>{{ $employee['departments']['name'] }}</td>
                <td>{{ $employee['salary']['amount'] }}</td>
                <td>{{ $employee['doj'] }}</td>
                <td>{{ $employee['dob'] }}</td>
                <td>
                    <a href="" class="btn btn-danger">view</a>
                </td>
                
            </tr>
            @endforeach
        
        @endif
    </table>

@endsection