@extends('layouts.user')

<head>
  <title>View Students</title>
</head>

@section('content')


    <!-- Main content -->
      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All Students</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Application Code</th>
                  <th>Name</th>
                  <th>passport Num</th>
                  <th>Email</th>
                  <th>Mobile</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($students as $allstudents)
                <tr>
                  <td>{{$allstudents->applications->code}}</td>
                  <td>{{$allstudents->first_name."  ".$allstudents->last_name}}</td>
                  <td>{{$allstudents->passport_number}}</td>
                  <td>{{$allstudents->email}}</td>
                  <td>{{$allstudents->mobile}}</td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Application Code</th>
                  <th>Name</th>
                  <th>passport Num</th>
                  <th>Email</th>
                  <th>Mobile</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

@endsection