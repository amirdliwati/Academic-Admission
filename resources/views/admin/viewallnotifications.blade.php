@extends('layouts.admin')
<head>
  <title>Notifications Admin</title>
</head>

@section('content')


    <!-- Main content -->


      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All Notifications</h3>
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
                  <th>Status</th>
                  <th>Time</th>
                  <th>Details</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($notifications as $mynotifications)
                <tr>
                  <td>{{$mynotifications->id}}</td>
                  <td>{{$mynotifications->operating}}</td>
                  <td>{{$mynotifications->application->code}}</td>
                  <td>{{$mynotifications->user->name}}</td>
                  @if ($mynotifications->seen == 1)
                  <td><button type="button" class="btn btn-success"  id="button1">Seen</button></td>
                  @else
                  <td><button type="button" class="btn btn-secondary" id="button1">Unseen</button></td>
                  @endif
                  <td>{{$mynotifications->created_at}}</td>
                  <td><a href="/home/viewapplicationsfromnotifications/{{$mynotifications->application_id}}/{{$mynotifications->id}}"><button type="button" class="btn btn-info " id="button1">View</button></a></td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Operating</th>
                  <th>Application Code</th>
                  <th>User Name</th>
                  <th>Status</th>
                  <th>Time</th>
                  <th>Details</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

@endsection