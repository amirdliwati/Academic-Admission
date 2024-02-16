@extends('layouts.admin')
<head>
  <title>History Users</title>
</head>
@section('content')


    <!-- Main content -->
      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Operating</th>
                  <th>Application Code</th>
                  <th>User Name</th>
                  <th>Time</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($logs as $alllog)
                <tr>
                  <td>{{$alllog->id}}</td>
                  <td>{{$alllog->operating}}</td>
                  <td>{{$alllog->application_code}}</td>
                  <td>{{$alllog->user_name}}</td>
                  <td>{{$alllog->created_at}}</td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Operating</th>
                  <th>Application Code</th>
                  <th>User Name</th>
                  <th>Time</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

@endsection