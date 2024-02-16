@extends('layouts.admin')
<head>
  <title>View Received From</title>
</head>
@section('content')


        <div class="container">
            <div class="card card-success">
                <div class="card-header">

                <h3 class="card-title">{{ __('Add New Received From') }}</h3>
                </div>

                <div class="card-body">
                    <form  id="payment" action="/home/addpaymentin" method="POST" >
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-6">
                              <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                              <label for="in_usd">{{ __('Payment USD') }}</label>
                                <input id="in_usd" type="text" class="form-control @error('in_usd') is-invalid @enderror" name="in_usd" value="{{ old('in_usd') }}" autocomplete="in_usd" autofocus placeholder="USD">

                                @error('in_usd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                    <label for="in_local" >{{ __('Payment Dinar Iraq') }}</label>
                                    <input id="in_local" type="text" class="form-control @error('in_local') is-invalid @enderror" name="in_local" value="{{ old('in_local') }}" autocomplete="in_local" autofocus placeholder="Dinar">
                                    
                                    @error('in_local')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-6">
                              <label for="about_payment">{{ __('Being Paid') }}</label>
                                <input id="about_payment" type="text" class="form-control @error('about_payment') is-invalid @enderror" name="about_payment" value="{{ old('about_payment') }}" required autocomplete="about_payment" autofocus placeholder="Being Paid">

                                @error('about_payment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                              <label for="amount">{{ __('Amount') }}</label>
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" autocomplete="amount" autofocus placeholder="Amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class=" col-md-6 btn btn-success">
                                    {{ __('Save') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

<br>
      
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">All Received From</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>USD</th>
                  <th>Dinar Iraq</th>
                  <th>Date</th>
                  <th>Being Paid</th>
                  <th>Amount</th>
                  <th>Download</th>
                  <th>Modify</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($payments as $payment)
                <tr>
                  <td>{{$payment->id}}</td>
                  <td>{{$payment->name}}</td>
                  <td>{{$payment->in_usd}}</td>
                  <td>{{$payment->in_local}}</td>
                  <td>{{$payment->date}}</td>
                  <td>{{$payment->about_payment}}</td>
                  <td>{{$payment->amount}}</td>
                  <td><a href="/home/downloadpayment/{{$payment->id}}" class="btn btn-info" id="button1">Download</a></td>
                  <td><button type="button" class="btn btn-danger " data-toggle="modal" data-target="#modal-danger{{$payment->id}}" id="button1">Delete</button></td>
                </tr>
            @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>USD</th>
                  <th>Dinar Iraq</th>
                  <th>Date</th>
                  <th>Being Paid</th>
                  <th>Amount</th>
                  <th>Download</th>
                  <th>Modify</th>
                </tr>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
</div>

@foreach ($payments as $payment)

      <div class="modal fade" id="modal-danger{{$payment->id}}">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Caution ??</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
              <h2>Are you Sure To Delete Payment Received ?</h2>
             <h4>{{$payment->id}}</h4>
            </div>
            <div class="modal-footer justify-content-between">
              
              <a href="deletepayment/{{$payment->id}}">
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

@endsection('content')
