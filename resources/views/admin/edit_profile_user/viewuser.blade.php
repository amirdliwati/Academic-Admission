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
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Created</th>
                  <th>Details</th>
                  <th>Edite</th>
                  <th>Status</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($users as $myuser)
                <tr>
                  <td>{{$myuser->id}}</td>
                  <td>{{$myuser->name}}</td>
                  <td>{{$myuser->email}}</td>
                  <td>{{$myuser->created_at}}</td>
                  <td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#modal-default{{$myuser->id}}" id="button1">View</button></td>
                  <td><a href="edituser/{{$myuser->id}}"><button type="button" class="btn btn-warning " id="button1">Edit</button></a></td>

                  @if ($myuser->status == "Activate")
                  <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-info{{$myuser->id}}" id="button1">Active</button></td>
                  @else
                  <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-info{{$myuser->id}}" id="button1">Inactive</button></td>
                  @endif
                
                  <td><button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-danger{{$myuser->id}}" id="button1">Delete</button></td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Created</th>
                  <th>Details</th>
                  <th>Edite</th>
                  <th>Status</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

@foreach ($country as $profile)
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

@foreach ($country as $iddelete)

      <div class="modal fade" id="modal-danger{{$iddelete->users_id}}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Danger ??</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <h2>Are you Sure To Delete User ?</h2>
             <h4>{{$iddelete->first_name}} {{"     "}} {{$iddelete->last_name}}</h4>
            </div>
            <div class="modal-footer justify-content-between">
              
              <a href="deleteuser/{{$iddelete->users_id}}">
              <button type="button" class="btn btn-outline-light">Yes</button>
            </a>
              
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">NO</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    @endforeach

    @foreach ($country as $idstatus)

    <div class="modal fade" id="modal-info{{$idstatus->users_id}}">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Alert !!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"> 
            <h2>Are you Sure To change status for</h2>
             <h4>{{$idstatus->first_name}} {{"     "}} {{$idstatus->last_name}} {{"     "}} ?</h4>
            </div>
            <div class="modal-footer justify-content-between">
            <a href="status/{{$idstatus->users_id}}">
              <button type="button" class="btn btn-outline-light" >Yes</button>
              </a>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


    @endforeach


@endsection