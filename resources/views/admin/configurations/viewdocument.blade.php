@extends('layouts.admin')
<head>
  <title>Documents Type</title>
</head>
@section('content')


    <!-- Main content -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">

                <h3 class="card-title">{{ __('Add Document type') }}</h3>
                </div>

                <div class="card-body">
                    <form  id="create" action="createdocument" method="POST" >
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other_info" class="col-md-4 col-form-label text-md-right">{{ __('Info') }}</label>

                            <div class="col-md-6">
                                <input id="other_info" type="text" class="form-control @error('other_info') is-invalid @enderror" name="other_info" value="{{ old('other_info') }}"  autocomplete="other_info" autofocus>

                                @error('other_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class=" col-md-6 btn btn-primary">
                                    {{ __('Add') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>



          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Type Of Documents</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Types</th>
                  <th>Info</th>

                </tr>
                </thead>
                <tbody>
            @foreach ($types as $mytypes)
                <tr>
                  <td>{{$mytypes->name}}</td>
                  <td>{{$mytypes->other_info}}</td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                <th>Types</th>
                  <th>Info</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
          </div>
          </div>

          

@endsection