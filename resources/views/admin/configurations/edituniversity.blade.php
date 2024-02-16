@extends('layouts.admin')
<head>
  <title>View University & Departments</title>
</head>
@section('content')


        <div class="container">
            <div class="card card-info">
                <div class="card-header">

                <h3 class="card-title">{{ __('Add New University') }}</h3>
                </div>

                <div class="card-body">
                    <form  id="register" action="/home/adduniversity" method="POST" >
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-5">
                              <label for="university-name">{{ __('University Name') }}</label>
                                <input id="university-name" type="text" class="form-control @error('university-name') is-invalid @enderror" name="university-name" value="{{ old('university-name') }}" required autocomplete="university-name" autofocus placeholder="University Name">

                                @error('university-name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                              <label for="department-name">{{ __('Department Name') }}</label>
                                <input id="department-name" type="text" class="form-control @error('department-name') is-invalid @enderror" name="department-name" value="{{ old('department-name') }}" required autocomplete="department-name" autofocus placeholder="Department Name">

                                @error('department-name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                    <label for="Stream" >{{ __('Stream') }}</label>
                                    <select id="Stream" name="Stream" class="form-control custom-select @error('Stream') is-invalid @enderror" style="width: 100%;"   autocomplete="Stream" autofocus >
                                        <option selected="selected" value="{{ old('Stream') }}">{{ old('Stream') }}</option>
                                        <option value="Bachelor ">Bachelor </option>
                                        <option value="Master ">Master </option>
                                        <option value="Phd ">Phd </option>
                                        <option value="Vocational School ">Vocational School </option>
                                    </select>
                                    
                                    @error('Stream')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class=" col-md-6 btn btn-info">
                                    {{ __('ADD') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

<br>
      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All University & Departments</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>University Name</th>
                  <th>Department Name </th>
                  <th>Stream</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($University_department as $university)
                <tr>
                  <td>{{$university->id}}</td>
                  <td>{{$university->university_name}}</td>
                  <td>{{$university->department_name}}</td>
                  <td>{{$university->stream}}</td>
                  <td><button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-danger{{$university->id}}" id="button1">Delete</button></td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>University Name</th>
                  <th>Department Name </th>
                  <th>Stream</th>
                  <th>Delete</th>
                </tr>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
</div>

@foreach($University_department as $university)

      <div class="modal fade " id="modal-danger{{$university->id}}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Danger ??</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <h2>Are you Sure To Delete this University {{$university->university_name}} ?</h2>
            </div>
            <div class="modal-footer justify-content-between">
            <a href="/home/deleteuniversity/{{$university->id}}"><button type="button" class="btn btn-outline-light">Yes</button></a>
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">NO</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    @endforeach
@endsection