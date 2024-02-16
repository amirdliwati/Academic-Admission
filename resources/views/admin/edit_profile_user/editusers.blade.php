@extends('layouts.admin')
<head>
  <title>Edit Profile User</title>
</head>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">

                <h3 class="card-title">{{ __('Update Details User') }}</h3>
                </div>

                <div class="card-body">

                	<form method="POST" action="/home/edituser/{{$detailsusers->id}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$detailsusers->name}}" required autocomplete="name" autofocus disabled >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>-->

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$detailsusers->users_profiles->first_name}}" required autocomplete="first_name" autofocus placeholder="First Name">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$detailsusers->users_profiles->last_name}}" required autocomplete="last_name" autofocus placeholder="Last Name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{$detailsusers->users_profiles->mobile}}" required autocomplete="mobile" autofocus placeholder="+">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-8">

                            
                            <select id="country" name="country" class="form-control select2" style="width: 100%;" required autocomplete="country" autofocus value="{{$detailsusers->users_profiles->country->en_short_name}}">
                            <option selected="selected" value="{{$detailsusers->users_profiles->country->num_code}}">{{$detailsusers->users_profiles->country->en_short_name}}</option>
                            @foreach($allcountries as $selectitems)
                            <option value="{{$selectitems->num_code}}">{{$selectitems->en_short_name}}</option>
                            @endforeach
                            </select>
                                
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$detailsusers->users_profiles->city_name}}" required autocomplete="city" autofocus placeholder="City">   
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class=" col-md-6 btn btn-primary">
                                    {{ __('Save') }}
                                </button>

                            
                            
                                <a href="/home/viewuser">
                                    <button type="button" class="btn btn-warning">
                                    {{ __('Back') }}
                                </button> </a>
                                </div>
                            
                        </div>


                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection