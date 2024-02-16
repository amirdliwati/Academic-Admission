@extends('layouts.admin')
<head>
  <title>View Users</title>
</head>
@section('content')


    <!-- Main content -->


          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Created</th>
                  <th>Details</th>
                  <th>Password</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($users as $myuser)
                <tr>
                  <td>{{$myuser->id}}</td>
                  <td>{{$myuser->name}}</td>
                  <td>{{$myuser->email}}</td>
                  <td>{{$myuser->created_at}}</td>
                  <td><button type="button" class="btn btn-info swalDefaultWarning" data-toggle="modal" data-target="#modal-default{{$myuser->id}}" id="button1">View</button></td>
                  <td><a href="resetpassworduser/{{$myuser->id}}"><button type="button" class="btn btn-warning swalDefaultWarningbtn" id="button1">Reset</button></a></td>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Created</th>
                  <th>Details</th>
                  <th>Password</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


      @foreach ($profiles as $profile)
        <div class="modal fade" id="modal-default{{$profile->users_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Details User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile</th>
                  <th>country</th>
                  <th>City</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                  <td>{{$profile->first_name}}</td>
                  <td>{{$profile->last_name}}</td>
                  <td>{{$profile->mobile}}</td>
                  <td>{{$profile->country->en_short_name}}</td>
                  <td>{{$profile->city_name}}</td>
                  
                </tr>

                </tbody>
              </table>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      @endforeach
    



@endsection