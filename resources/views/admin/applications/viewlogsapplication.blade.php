@extends('layouts.admin')
<head>
  <title>View Logs Application</title>
</head>
@section('content')


    <!-- Main content -->


      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">History For Application</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Application Code</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>History</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($allapplication as $historyapplication)
                <tr>
                  <td>{{$historyapplication->code}}</td>

                  @if($historyapplication->status == "New")
                    <td><button type="button" class="btn btn-secondary"  id="button1">New</button></td>
                    @elseif($historyapplication->status == "Under Process")
                    <td><button type="button" class="btn btn-warning"  id="button1">UnderProcess</button></td>
                    @elseif($historyapplication->status == "Accepted")
                    <td><button type="button" class="btn btn-success"  id="button1">Accepted</button></td>
                    @elseif($historyapplication->status == "Rejected")
                    <td><button type="button" class="btn btn-danger"  id="button1">Rejected</button></br>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-rejectd{{$historyapplication->id}}" id="button1">Reasons</button>
                    </td>
                    @else
                    <td><button type="button" class="btn btn-info"  id="button1">Updated</button></td>
                    @endif

                  <td>{{$historyapplication->created_at}}</td>
                  <td>{{$historyapplication->updated_at}}</td>

                  <td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#modal-default{{$historyapplication->id}}" id="button1">View</button></td>

                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Application Code</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>History</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


          @foreach ($allapplication as $history)
        <div class="modal fade" id="modal-default{{$history->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">History Application</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Operating</th>
                  <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($history->admin_notifications as $details)
                <tr>
                  <td>{{$details->created_at}}</td>
                  <td>{{$details->operating}}</td>
                  
                </tr>
                @endforeach

                @foreach ($history->user_notifications as $details)
                <tr>
                  <td>{{$details->created_at}}</td>
                  <td>{{$details->operating}}</td>
                </tr>
                @endforeach

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

      @foreach($allapplication as $applicationstatus)

    <div class="modal fade" id="modal-rejectd{{$applicationstatus->id}}">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
          
            <div class="modal-header">
              <h4 class="modal-title">Reasons !!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"> 
            <h2>{{$applicationstatus->info_application}}</h2>      
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    @endforeach

@endsection