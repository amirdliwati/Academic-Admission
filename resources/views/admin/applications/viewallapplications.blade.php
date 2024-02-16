@extends('layouts.admin')

<head>
  <title>{{$status}} Applications</title>
</head>

@section('content')
    <!-- Main content -->

        <a href="/home/exportecel"><button type="button" class="btn btn-success " id="button1">Export To Excel</button></a></td>
      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{$status}} Applications</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Student Name</th>
                  <th>Program</th>
                  <th>Program Semester</th>
                  <th>Program Level</th>
                  <th>University</th>
                  <th>Details</th>
                  <th>Status</th>
                  <th>Edite</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
            @foreach($allapplication as $myapplication)
                <tr>
                  <td>{{$myapplication->id}}</td>
                  <td>{{$myapplication->code}}</td>
				          <td>{{$myapplication->student->first_name}}  {{" "}} {{$myapplication->student->last_name}}</td>
                  @foreach ($myapplication->student->programs as $detailsstudent)
                  <td>{{$detailsstudent->p_name}}</td>
                  <td>{{$detailsstudent->p_semester}}</td>
                  <td>{{$detailsstudent->p_level}}</td>
                  <td>{{$detailsstudent->institute_name}}</td>
                  @break
                  @endforeach
                  <td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#modal-default{{$myapplication->id}}" id="button1">View</button></td>
                  

                @if($myapplication->status == "New")
                <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-status{{$myapplication->id}}" id="button1">New</button></td>
                @elseif($myapplication->status == "Under Process")
                <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-status{{$myapplication->id}}" id="button1">UnderProcess</button></td>
                @elseif($myapplication->status == "Accepted")
                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-status{{$myapplication->id}}" id="button1">Accepted</button></td>
                @elseif($myapplication->status == "Rejected")
                <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-status{{$myapplication->id}}" id="button1">Rejected</button></br>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-rejectd{{$myapplication->id}}" id="button1">Reasons</button>
                </td>
                @else
                <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-status{{$myapplication->id}}" id="button1">Updated</button></td>
                @endif
                <td><a href="/home/editapplication/{{$myapplication->id}}"><button type="button" class="btn btn-warning " id="button1">Edit</button></a></td>
                <td><button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-danger{{$myapplication->id}}" id="button1">Delete</button></td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Student Name</th>
                  <th>Program</th>
                  <th>Program Semester</th>
                  <th>Program Level</th>
                  <th>University</th>
                  <th>Details</th>
                  <th>Status</th>
                  <th>Edite</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


          @foreach ($allapplication as $profile)
        <div class="modal fade" id="modal-default{{$profile->id}}">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
           
           <h4 class="modal-title"> {{"Application Details:    "}}<b>{{$profile->student->first_name}}  {{" "}} {{$profile->student->last_name}}</b></h4></br>
                    
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                Information:{{"   "}}<b>{{$profile->student->email}}</b> {{" "}}{{"Mobile:"}}{{" "}}<b>{{$profile->student->mobile}}</b> 
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td colspan="2">Middle Name:</td>
                  <td colspan="2"><b>{{$profile->student->middle_name}}</b></td>
                </tr>
                <tr>
                  <td>nationality:</td>
                  <td><b>{{$profile->student->nationality->nationality}}</b></td>
                  
                  <td colspan="2">Passport Number:</td>
                  <td colspan="3"><b>{{$profile->student->passport_number}}</b></td>
                </tr>
                <tr>
                  <td>Birth Date:</td>
                  <td><b>{{$profile->student->date_birth}}</b></td>
                  <td>Gender:</td>
                  <td><b>{{$profile->student->gender}}</b></td>
                  <td>Marital:</td>
                  <td><b>{{$profile->student->marital_status}}</b></td>
                </tr>
                <tr>
                  <td>Disability:</td>
                  <td><b>{{$profile->student->disability}}</b></td>
                  <td>Facilitie:</td>
                  <td colspan="2"><b>{{$profile->student->facilitie}}</b></td>
                </tr>
                <tr>
                <td>How:</td>
                <td colspan="7"><b>{{$profile->student->howfindus->how}}</b></td>
                </tr>
                <tr>
                <td>Note:</td>
                <td colspan="7"><b>{{$profile->student->note}}</b></td>
                </tr>

                

                @foreach ($profile->student->educatioals as $edu)
                <tr>
                <td colspan="8">Educational Backgrounds:{{"   "}} <b>{{$edu->attended}}</b></td>
                </tr>
                <tr>
                  <td colspan="2">Student Number:</td>
                  <td colspan="2"><b>{{$edu->student_number}}</b></td>
                  <td colspan="1">Instituate/Depatment:</td>
                  <td colspan="3"><b>{{$edu->instituate_depatment}}</b></td>
                </tr>
                <tr>
                  <td>Yers From:</td>
                  <td colspan="3"><b>{{$edu->yers_from}}</b></td>
                  <td>Yers To:</td>
                  <td colspan="3"><b>{{$edu->years_to}}</b></td>
                </tr>
                <tr>
                  <td>Type Degree:</td>
                  <td colspan="3"><b>{{$edu->type_degree}}</b></td>
                  <td>Latest Grade:</td>
                  <td colspan="3"><b>{{$edu->latest_grade}}</b></td>
                </tr>
                @endforeach

                @foreach ($profile->student->programs as $pro)
                <tr>
                <td colspan="8">{{$pro->type_program}}:{{"   "}}<b>{{$pro->p_level}}</b></td>
                </tr>
                <tr>
                  <td>Program Name:</td>
                  <td colspan="3"><b>{{$pro->p_name}}</b></td>
                  <td>University:</td>
                  <td colspan="3"><b>{{$pro->institute_name}}</b></td>

                </tr>
                <tr>
                  <td>Semester:</td>
                  <td colspan="2"><b>{{$pro->p_semester}}</b></td>
                  <td colspan="2">Direct/Transfer:</td>
                  <td><b>{{$pro->direct_transfer}}</b></td>
                </tr>
                @endforeach


                </tbody>
              </table>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              <a href="/home/viewdocument/{{$profile->student->id}}">
              <button type="button" class="btn btn-success">View Document</button>
              </a>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      @endforeach

@foreach($allapplication as $iddelete)

      <div class="modal fade " id="modal-danger{{$iddelete->id}}">
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
             <h4>{{$iddelete->code}} {{"  ?"}}</h4>
            </div>
            <div class="modal-footer justify-content-between">
            <a href="/home/deleteapplication/{{$iddelete->student->id}}"><button type="button" class="btn btn-outline-light">Yes</button></a>
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">NO</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    @endforeach

    @foreach($allapplication as $applicationstatus)

    <div class="modal fade" id="modal-status{{$applicationstatus->id}}">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
          
            <div class="modal-header">
              <h4 class="modal-title">Alert !!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"> 
            <h2>Are you Sure To change status ?</h2>
            <a href="/home/changestatusapplication/{{$applicationstatus->id}}/Under Process"><button type="button" class="btn btn-warning" id="button1">Under Process</button></a>
                </br>
                </br>

                <form method="post" action="/home/changestatusapplication/{{$applicationstatus->id}}/Accepted" enctype="multipart/form-data" id="accept">
                        @csrf 
                <div class="col-md-12">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" name="document" required onchange="Filevalidation()">
                                        @error('document')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                    
                                        <div class="input-group-append">
                                            <span class="input-group-append" id=""><button type="submit" class="btn btn-success" id="button1">Accept</button></span>
                                        </div>
                                </div>
                        </div>
                </form>

                </br>
                </br> 
                <form method="get" action="/home/changestatusapplication/{{$applicationstatus->id}}/Rejected" id="reject">
                  @csrf              
                <textarea class="form-control" rows="3" placeholder="Enter Reasons for Rejecting ..." id="reasons_reject" name="reasons_reject" required></textarea>
                <button type="submit" class="btn btn-danger"  id="reject">Reject</button>
                </form>
                      
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

    <div class="modal fade " id="modal-file">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Alert !!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <h2>File too Big, please select a file less or equal than 5MB</h2>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">OK</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    <script> 
    Filevalidation = () => { 
        const fi = document.getElementById('document'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 5120) {
                $('#modal-file').modal('show');
                $("#document").val(null);
                    
                } else { 
                    document.getElementById('size').innerHTML = '<b>'
                    + file + '</b> KB'; 
                } 
            } 
        } 
    } 
</script> 

@endsection

