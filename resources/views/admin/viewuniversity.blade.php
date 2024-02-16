@extends('layouts.admin')
<head>
  <title>View University & Departments</title>
</head>
@section('content')


        <div class="container">
            <div class="card card-success">
                <div class="card-header">

                <h3 class="card-title">{{ __('Search New University') }}</h3>
                </div>

                <div class="card-body">
                    <form  id="register" action="/home/finduniversity" method="POST" >
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-5">
                                <label for="university_name" class=" col-form-label ">{{ __('University Name') }}</label>
                                <select id="university_name" name="university_name" class="form-control select2 @error('university_name') is-invalid @enderror" style="width: 100%;"   autocomplete="university_name" autofocus >
                                    <option selected="selected" value="{{ old('university_name') }}">{{ old('university_name') }}</option>
                                    @foreach ($universities as $university)
                                    <option value="{{$university->university_name}}">{{$university->university_name}}</option>
                                    @endforeach
                                </select>
                                
                                @error('university_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label for="department_name" class=" col-form-label ">{{ __('Department Name') }}</label>
                                <select id="department_name" name="department_name" class="form-control select2 @error('department_name') is-invalid @enderror" style="width: 100%;"   autocomplete="department_name" autofocus >
                                    <option selected="selected" value="{{ old('department_name') }}">{{ old('department_name') }}</option>
                                    @foreach ($departments as $department)
                                    <option value="{{$department->department_name}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                                
                                @error('department_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
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
                                <button type="submit" class=" col-md-6 btn btn-success">
                                    {{ __('Find') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

<br>

      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All Available University & Departments</h3>
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
                  <th>Created At</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($University_department as $university)
                <tr>
                  <td>{{$university->id}}</td>
                  <td>{{$university->university_name}}</td>
                  <td>{{$university->department_name}}</td>
                  <td>{{$university->stream}}</td>
                  <td>{{$university->created_at}}</td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>University Name</th>
                  <th>Department Name </th>
                  <th>Stream</th>
                  <th>Created At</th>
                </tr>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
</div>
@endsection