@extends('layouts.admin')
<head>
  <title>View Payments IN</title>
</head>
@section('content')
<form  id="payment" action="/home/payments" method="POST" >
    @csrf
  <div class="row">
    <div class="col-md-12">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Search By Date</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-2">
              <label for="date">{{ __('Chose Date For Search') }}</label>
            </div>
            <div class="col-md-6">
                  <input id="name" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus placeholder="date">

                  @error('date')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
            </div>
            <div class="col-md-4">
                <button type="submit" class=" col-md-6 btn btn-info">
                    {{ __('Find') }}
                </button>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</form>
  

  <div class="row">
    <div class="col-md-12">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Totals</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <label for="t1">{{ __('Total USD Received') }}</label>
                <input id="t1" type="text" class="form-control @error('t1') is-invalid @enderror" name="t1" value="{{ $t1 }}" required autocomplete="t1" autofocus readonly>
            </div>

            <div class="col-md-3">
              <label for="t2">{{ __('Total Dinar Received') }}</label>
                <input id="t2" type="text" class="form-control @error('t2') is-invalid @enderror" name="t2" value="{{ $t2}}" required autocomplete="t2" autofocus readonly>
            </div>

            <div class="col-md-3">
              <label for="t3">{{ __('Total USD Paid') }}</label>
                <input id="t3" type="text" class="form-control @error('t3') is-invalid @enderror" name="t3" value="{{ $t3 }}" required autocomplete="t3" autofocus readonly>
            </div>

            <div class="col-md-3">
              <label for="t4">{{ __('Total Dinar Paid') }}</label>
                <input id="t4" type="text" class="form-control @error('t4') is-invalid @enderror" name="t4" value="{{ $t4 }}" required autocomplete="t4" autofocus readonly>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Results</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <label for="r1">{{ __('Result USD ') }}</label>
                <input id="r1" type="text" class="form-control @error('r1') is-invalid @enderror" name="r1" value="{{ $r1 }}" required autocomplete="r1" autofocus readonly>
            </div>

            <div class="col-md-6">
              <label for="r2">{{ __('Result Dinar ') }}</label>
                <input id="r2" type="text" class="form-control @error('r2') is-invalid @enderror" name="r2" value="{{ $r2}}" required autocomplete="r2" autofocus readonly>
            </div>

          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">All Received From</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>Name</th>
                <th>USD</th>
                <th>Dinar</th>
                <th>Date</th>
                <th>Being Paid</th>
            </tr>
            </thead>
            <tbody>
        @foreach ($paymentsIn as $paymentIn)
            <tr>
                <td>{{$paymentIn->name}}</td>
                <td>{{$paymentIn->in_usd}}</td>
                <td>{{$paymentIn->in_local}}</td>
                <td>{{$paymentIn->date}}</td>
                <td>{{$paymentIn->about_payment}}</td>
            </tr>
        @endforeach

            </tbody>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>USD</th>
              <th>Dinar</th>
              <th>Date</th>
              <th>Being Paid</th>
            </tr>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">All Paid To</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="datatable-buttons1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
              <th>Name</th>
              <th>USD</th>
              <th>Dinar</th>
              <th>Date</th>
              <th>Being Paid</th>
            </tr>
            </thead>
            <tbody>
        @foreach ($paymentsOut as $paymentOut)
            <tr>
              <td>{{$paymentOut->name}}</td>
              <td>{{$paymentOut->in_usd}}</td>
              <td>{{$paymentOut->in_local}}</td>
              <td>{{$paymentOut->date}}</td>
              <td>{{$paymentOut->about_payment}}</td>
            </tr>
        @endforeach

            </tbody>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>USD</th>
              <th>Dinar</th>
              <th>Date</th>
              <th>Being Paid</th>
            </tr>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

@endsection('content')
