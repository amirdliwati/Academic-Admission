@extends('layouts.user')
<head>
  <title>Upload Document</title>
</head>
@section('content')

<div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Step 4: Upload Documents') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </div>
                </div>
                
                <div class="card-body">

                        <div class="form-group row">
                            <label for="First_Program" class="col-md-12 col-form-label ">{{ __('Please upload the latest Degree, latest Transscript of your student, and also upload other documents such as Translation of Original documents if it is not English. International valid Passport. Reference and Recommendation letters. Publications, Language Certificates is it is available. Each File should be MAX 5 Megabytes.') }}</label>
                        </div> <!-- /.form-group row -->
                        
                        <form method="post" action="/home/uploaddocumentsubmit/{{$idstudent}}" enctype="multipart/form-data" id="edit">
                        @csrf
                        <div class="form-group row">
                        <div class="col-md-6">
                                <label for="Document_Type" class=" col-form-label ">{{ __('Document Type') }}</label>
                                <select id="Document_Type" name="Document_Type" class="form-control select2 @error('Document_Type') is-invalid @enderror" style="width: 100%;"  autocomplete="Document_Type" autofocus value="{{ old('Document_Type') }}" required>
                                    <option selected="selected" value="" >Selecte Document Type</option>
                                        @foreach($typesdocuments as $selectitems)
                                    <option value="{{$selectitems->name}}">{{$selectitems->name}}</option>
                                        @endforeach
                                </select>
                                @error('Document_Type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="document">File input</label>
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
                                            <span class="input-group-append" id=""><button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-overlay"> {{ __('Upload') }} </button></span>
                                        </div>
                                        
                                </div>
                                
                        </div>
                        
                        </div><!-- /.form-group row -->
                        </form>

                        <div class="form-group row">
                           
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                           
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                           
                        </div> <!-- /.form-group row -->


                    <div class="col-md-12">

                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th>Orginal File Name</th>
                                <th>Document Type</th>
                                <th>Upload Date</th>
                                <th>Download</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($students_documents as $selectitems)
                                <tr>
                                    <td>{{$selectitems->doucment_name}}</td>
                                    <td>{{$selectitems->docyment_type}}</td>
                                    <td>{{$selectitems->created_at}}</td>
                                    <td><a target="_blank" href="/{{$selectitems->document_path}}"><button type="button" class="btn btn-info " id="button1">Download</button></a></td>
                                    <td><button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-danger{{$selectitems->id}}" id="button1">Delete</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Orginal File Name</th>
                                <th>Document Type</th>
                                <th>Upload Date</th>
                                <th>Download</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                        
                </div><!-- /.card-body -->
            </div><!-- /.card card-primary -->

            <div class="row">
        <div class="col-md-12">
                <a href="/home/viewallapplications1"><button type="button" class=" col-md-3 btn btn-primary"> {{ __('Save') }} </button> </a>
                <a href="/home/submitapplication/{{$idstudent}}"><button type="button" class=" col-md-3 btn btn-success"> {{ __('Submit') }} </button> </a>
        </div>
    </div>



@foreach($students_documents as $selectitems)

      <div class="modal fade " id="modal-danger{{$selectitems->id}}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Danger ??</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <h2>Are you Sure To Delete this file?</h2>
            </div>
            <div class="modal-footer justify-content-between">
            <a href="/home/deletedocumentsubmit/{{$selectitems->id}}"><button type="button" class="btn btn-outline-light">Yes</button></a>
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">NO</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    @endforeach

    <div class="modal fade" id="modal-overlay">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="overlay d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="modal-body">
              <p>Please Wait............</p>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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