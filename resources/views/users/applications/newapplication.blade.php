@extends('layouts.user')
<head>
  <title>Create Application</title>
</head>
@section('content')

<form method="POST" action="/home/createapplication" id="edit">
     @csrf
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <b>Creat New Application</b></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
        <!-- /.content-header -->

 
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Step 1: Student Information ') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </div>
                </div>
                <div class="card-body">

                        <div class="form-group row">
                        
                            <div class="col-md-3">
                            <label for="First_Name" class=" col-form-label ">{{ __('First Name') }}</label>
                                <input id="First_Name" type="text" class="form-control @error('First_Name') is-invalid @enderror" name="First_Name" value="{{ old('First_Name') }}"   autocomplete="First_Name" autofocus placeholder="First Name" >

                                @error('First_Name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="Middle_Name" class=" col-form-label ">{{ __('Middle Name') }}</label>
                                <input id="Middle_Name" type="text" class="form-control @error('Middle_Name') is-invalid @enderror" name="Middle_Name" value="{{ old('Middle_Name') }}"   autocomplete="Middle_Name" autofocus placeholder="Middle Name" >

                                @error('Middle_Name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="Last_Name" class=" col-form-label ">{{ __('Surname/Last Name') }}</label>
                                <input id="Last_Name" type="text" class="form-control @error('Last_Name') is-invalid @enderror" name="Last_Name" value="{{ old('Last_Name') }}"   autocomplete="Last_Name" autofocus placeholder="Last Name">

                                @error('Last_Name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="Gender" class=" col-form-label ">{{ __('Gender') }}</label>
                                <select id="Gender" name="Gender" class="form-control select2 @error('Gender') is-invalid @enderror" style="width: 100%;"   autocomplete="Gender" autofocus >
                                    <option selected="selected" value="{{ old('Gender') }}">{{ old('Gender') }}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                
                                @error('Gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-md-3">
                            <label for="Date" class=" col-form-label ">{{ __('Date Of Birth (dd/mm/yyyy)') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                    <input id="Date" type="text" class="form-control @error('Date') is-invalid @enderror" name="Date" value="{{ old('Date') }}"   autocomplete="Date" autofocus data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                </div>

                                @error('Date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="Nationality" class=" col-form-label ">{{ __('Nationality') }}</label>
                                <select id="Nationality" name="Nationality" class="form-control select2 @error('Nationality') is-invalid @enderror" style="width: 100%;"   autocomplete="Nationality" autofocus>
                                    <option selected="selected" value="{{ old('Nationality') }}">{{ old('Nationality') }}</option>
                                        @foreach($allcountries as $selectitems)
                                    <option value="{{$selectitems->num_code}}">{{$selectitems->nationality}}</option>
                                        @endforeach
                                </select>
                                
                                @error('Nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="Passport" class=" col-form-label ">{{ __('Passport Number') }}</label>
                                <input id="Passport" type="text" class="form-control @error('Passport') is-invalid @enderror" name="Passport" value="{{ old('Passport') }}"   autocomplete="Passport" autofocus placeholder="Passport Number" >

                                @error('Passport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="Marital" class=" col-form-label ">{{ __('Marital Status') }}</label>
                                <select id="Marital" name="Marital" class="form-control select2 @error('Marital') is-invalid @enderror" style="width: 100%;"   autocomplete="Marital" autofocus>
                                    <option selected="selected" value="{{ old('Marital') }}">{{ old('Marital') }}</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Separated ">Separated </option>
                                    <option value="Divorced ">Divorced </option>
                                    <option value="Widowed ">Widowed </option>
                                </select>
                                
                                @error('Marital')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-md-3">
                            <label for="Disability" class="col-form-label ">{{ __('Do you have any disability?') }}</label>
                                <select id="Disability" name="Disability" class="form-control select2 @error('Disability') is-invalid @enderror" style="width: 100%;"   autocomplete="Disability" autofocus>
                                    <option selected="selected" value="{{ old('Disability') }}"> {{ old('Disability') }}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                
                                @error('Disability')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="Facilities" class="col-form-label ">{{ __('Facilities you Required ?') }}</label>
                                <input id="PassFacilitiesport" type="text" class="form-control @error('Facilities') is-invalid @enderror" name="Facilities" value="{{ old('Facilities') }}"   autocomplete="Facilities" autofocus placeholder="Facilities" >

                                @error('Facilities')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                            <label for="How" class="col-form-label ">{{ __('How did you Find Us:') }}</label>
                                <select id="How" name="How" class="form-control select2 @error('How') is-invalid @enderror" style="width: 100%;"   autocomplete="How" autofocus>
                                    <option selected="selected" value="{{ old('How') }}">{{ old('How') }}</option>
                                        @foreach($how as $selectitems)
                                    <option value="{{$selectitems->id}}">{{$selectitems->how}}</option>
                                        @endforeach
                                </select>
                                
                                @error('How')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-md-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                    @error('email')
                                     <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                            <label for="mobile" class="col-form-label ">{{ __('Mobile Number') }}</label>
                            <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">+</span></div>
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}"   autocomplete="mobile" autofocus placeholder="Mobile Number" >

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="col-md-5">
                            <label for="Facilities" class="col-form-label ">{{ __('Note') }}</label>
                             <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror" rows="3" placeholder="Enter note..." value="{{ old('note') }}"   autocomplete="note" autofocus></textarea>
                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                        </div> <!-- /.form-group row -->

                </div><!-- /.card-body -->
            </div><!-- /.card card-primary -->

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Step 2: Educational Background ') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        
                        <div class="col-md-6">
                            <label for="attended" class=" col-form-label ">{{ __('Have Student ever attended  any educational program in ?') }}</label>
                            <select id="attended" name="attended" class="form-control select2  @error('attended') is-invalid @enderror" style="width: 100%;"   autocomplete="attended" autofocus>
                                <option selected="selected" value="{{ old('attended') }}">{{ old('attended') }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            
                            @error('attended')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="student_number" class=" col-form-label ">{{ __('What was the student number ?') }}</label>
                            <input id="student_number" type="text" class="form-control @error('student_number') is-invalid @enderror" name="student_number" value="{{ old('student_number') }}"   autocomplete="student_number" autofocus placeholder="Student Number" >

                            @error('student_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> <!-- /.form-group row -->

                    <div class="form-group row">
                    <label for="educational_Detail" class="col-md-3 col-form-label ">{{ __('Latest educational Detail') }}</label>
                    </div> <!-- /.form-group row -->

                    <div class="form-group row">
                        
                            <div class="col-md-3">
                            <label for="Institute" class=" col-form-label ">{{ __('a.Institute/Department') }}</label>
                                <input id="Institute" type="text" class="form-control @error('Institute') is-invalid @enderror" name="Institute" value="{{ old('Institute') }}"   autocomplete="Institute" autofocus placeholder="Institute Name" >

                                @error('Institute')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                            <label for="Yars_From" class=" col-form-label ">{{ __('b.Years From') }}</label>
                                <input id="Yars_From" type="text" class="form-control @error('Yars_From') is-invalid @enderror" name="Yars_From" value="{{ old('Yars_From') }}"   autocomplete="Yars_From" autofocus placeholder="Yars From" >

                                @error('Yars_From')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                            <label for="Years_To" class=" col-form-label ">{{ __('Years To') }}</label>
                                <input id="Years_To" type="text" class="form-control @error('Years_To') is-invalid @enderror" name="Years_To" value="{{ old('Years_To') }}"   autocomplete="Years_To" autofocus placeholder="Years To">

                                @error('Years_To')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                            <label for="type_degree" class=" col-form-label ">{{ __('c.Type of Degree 1/Degree 2') }}</label>
                                <input id="type_degree" type="text" class="form-control @error('type_degree') is-invalid @enderror" name="type_degree" value="{{ old('type_degree') }}"   autocomplete="type_degree" autofocus placeholder="Type Degree">

                                @error('type_degree')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                            <label for="latest_grade" class=" col-form-label ">{{ __('d.Latest grade') }}</label>
                                <input id="latest_grade" type="text" class="form-control @error('latest_grade') is-invalid @enderror" name="latest_grade" value="{{ old('latest_grade') }}"   autocomplete="latest_grade" autofocus placeholder="Latest Grade">

                                @error('latest_grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> <!-- /.form-group row -->

                </div><!-- /.card-body -->
            </div><!-- /.card card-primary -->

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Step 3: Select Your Program ') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </div>
                </div>
                <div class="card-body">

                        <div class="form-group row">
                            <label for="info_program" class="col-md-12 col-form-label ">{{ __('Please be informed that the below Master and Ph.D program price indicate the tuition fee per course and undergraduate program prices indicate the tuition fee per semester. Price do not include additional fees such as bench fees. Social activities fees etc. ') }}</label>
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                            <label for="First_Program" class="col-md-3 col-form-label ">{{ __('a.First Program') }}</label>
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="Program_Semester" class=" col-form-label ">{{ __('Program Semester:') }}</label>
                                <select id="Program_Semester" name="Program_Semester" class="form-control select2 @error('Program_Semester') is-invalid @enderror" style="width: 100%;"   autocomplete="Program_Semester" autofocus>
                                    <option selected="selected" value="{{ old('Program_Semester') }}">{{ old('Program_Semester') }}</option>
                                    <option value="Fall">Fall</option>
                                    <option value="Spring">Spring</option>
                                    <option value="Summer">Summer</option>
                                </select>
                            
                                @error('Program_Semester')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="Program_Level" class=" col-form-label ">{{ __('Program Level:') }}</label>
                                <select id="Program_Level" name="Program_Level" class="form-control select2 @error('Program_Level') is-invalid @enderror" style="width: 100%;"   autocomplete="Program_Level" autofocus>
                                    <option selected="selected" value="{{ old('Program_Level') }}">{{ old('Program_Level') }}</option>
                                    <option value="Summer School">Summer School</option>
                                    <option value="Vocational School">Vocational School</option>
                                    <option value="Undergraduate">Undergraduate</option>
                                    <option value="Master With Thesis">Master With Thesis</option>
                                    <option value="Master Without Thesis">Master Without Thesis</option>
                                    <option value="PhD">PhD</option>
                                </select>
                            
                                @error('Program_Level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="direct_transfer" class=" col-form-label ">{{ __('3.Direct/Transfer:') }}</label>
                                <select id="direct_transfer" name="direct_transfer" class="form-control select2 @error('direct_transfer') is-invalid @enderror" style="width: 100%;"   autocomplete="direct_transfer" autofocus>
                                    <option selected="selected" value="{{ old('direct_transfer') }}">{{ old('direct_transfer') }}</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="Direct">Direct</option>
                                </select>
                            
                                @error('direct_transfer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        
                        </div><!-- /.form-group row -->

                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="Faculty_Institute" class=" col-form-label ">{{ __('4.University') }}</label>
                                    <input id="Faculty_Institute" type="text" class="form-control @error('Faculty_Institute') is-invalid @enderror" name="Faculty_Institute" value="{{ old('Faculty_Institute') }}"   autocomplete="Faculty_Institute" autofocus placeholder="University">

                                    @error('Faculty_Institute')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="Program_Name" class=" col-form-label ">{{ __('5.Program Name') }}</label>
                                    <input id="Program_Name" type="text" class="form-control @error('Program_Name') is-invalid @enderror" name="Program_Name" value="{{ old('Program_Name') }}"   autocomplete="Program_Name" autofocus placeholder="Program Name">

                                    @error('Program_Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div><!-- /.form-group row -->

                        <div class="form-group row">
                            
                        </div> <!-- /.form-group row -->
                        
                        <div class="form-group row">
                            <label for="First_Program" class="col-md-3 col-form-label ">{{ __('b.Second Program Optional') }}</label>
                        </div> <!-- /.form-group row -->

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="Program_Semester2" class=" col-form-label ">{{ __('Program Semester:') }}</label>
                                <select id="Program_Semester2" name="Program_Semester2" class="form-control select2 @error('Program_Semester2') is-invalid @enderror" style="width: 100%;"  autocomplete="Program_Semester2" autofocus>
                                    <option selected="selected" value="{{ old('Program_Semester2') }}">{{ old('Program_Semester2') }}</option>
                                    <option value="Fall">Fall</option>
                                    <option value="Spring">Spring</option>
                                    <option value="Summer">Summer</option>
                                </select>
                            
                                @error('Program_Semester2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="Program_Level2" class=" col-form-label ">{{ __('Program Level:') }}</label>
                                <select id="Program_Level2" name="Program_Level2" class="form-control select2 @error('Program_Level2') is-invalid @enderror" style="width: 100%;"  autocomplete="Program_Level2" autofocus>
                                    <option selected="selected" value="{{ old('Program_Level2') }}">{{ old('Program_Level2') }}</option>
                                    <option value="Summer School">Summer School</option>
                                    <option value="Vocational School">Vocational School</option>
                                    <option value="Undergraduate">Undergraduate</option>
                                    <option value="Master With Thesis">Master With Thesis</option>
                                    <option value="Master Without Thesis">Master Without Thesis</option>
                                    <option value="PhD">PhD</option>
                                </select>
                            
                                @error('Program_Level2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="direct_transfer2" class=" col-form-label ">{{ __('3.Direct/Transfer:') }}</label>
                                <select id="direct_transfer2" name="direct_transfer2" class="form-control select2 @error('direct_transfer2') is-invalid @enderror" style="width: 100%;"  autocomplete="direct_transfer2" autofocus>
                                    <option selected="selected" value="{{ old('direct_transfer2') }}">{{ old('direct_transfer2') }}</option>
                                    <option value="Direct">Direct</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            
                                @error('direct_transfer2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                        </div><!-- /.form-group row -->

                        <div class="form-group row">

                            <div class="col-md-6">
                                <label for="Faculty_Institute2" class=" col-form-label ">{{ __('4.University') }}</label>
                                    <input id="Faculty_Institute2" type="text" class="form-control @error('Faculty_Institute') is-invalid @enderror" name="Faculty_Institute2" value="{{ old('Faculty_Institute2') }}"  autocomplete="Faculty_Institute2" autofocus placeholder="University">

                                    @error('Faculty_Institute2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="Program_Name2" class=" col-form-label ">{{ __('5.Program Name') }}</label>
                                    <input id="Program_Name2" type="text" class="form-control @error('Program_Name2') is-invalid @enderror" name="Program_Name2" value="{{ old('Program_Name2') }}"  autocomplete="Program_Name2" autofocus placeholder="Program Name">

                                    @error('Program_Name2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div><!-- /.form-group row -->
                        
                </div><!-- /.card-body -->
            </div><!-- /.card card-primary -->

           
            
            

        </div><!-- /.col -->
    </div><!-- row justify-content-center -->

                        
    <div class="row">
        <div class="col-md-12">
                <button type="submit" class=" col-md-3 btn btn-primary"> {{ __('Save') }} </button>
                <a href="/home"><button type="button" class=" col-md-3 btn btn-warning"> {{ __('Back To home') }} </button> </a>
        </div>
    </div>


</form>

@endsection