@extends('layouts.admin')
<head>
  <title>How Find Us</title>
</head>
@section('content')


    <!-- Main content -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">

                <h3 class="card-title">{{ __('Add') }}</h3>
                </div>

                <div class="card-body">
                    <form  id="create" action="createfindus" method="POST" >
                        @csrf

                        <div class="form-group row">

                        
                                <input id="how" type="text" class="form-control @error('how') is-invalid @enderror" name="how" value="{{ old('how') }}" required autocomplete="how" autofocus>

                                @error('how')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
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
              <h3 class="card-title">How Did you Find Us Controller</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>How Did you Find Us ??</th>

                </tr>
                </thead>
                <tbody>
            @foreach ($findus as $myfindus)
                <tr>
                  <td>{{$myfindus->how}}</td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>How Did you Find Us ??</th>
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