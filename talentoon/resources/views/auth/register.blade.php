@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label"> First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label"> Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                            <select class="form-control" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>

                          </select>

                            @if ($errors->has('gender'))
                            <span class="help-block">
                             <strong>{{ $errors->first('gender') }}</strong>
                             </span>
                            @endif
                         </div>
                    </div>
                            <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                <label for="date_of_birth" class="col-md-4 control-label">Date Of Birth</label>
                                <div class="col-md-6 form_datetime">
                               <input type="date" class="form-control" name="date_of_birth">
                               @if ($errors->has('date_of_birth'))
                               <span class="help-block">
                                <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                               @endif

                               </div>
                          </div>
                          <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                              <label for="image" class="col-md-4 control-label">Profile Picture</label>
                              <div class="col-md-6 form_datetime">
                             <input type="file" class="form-control" name="image">
                             @if ($errors->has('image'))
                             <span class="help-block">
                              <strong>{{ $errors->first('image') }}</strong>
                              </span>
                             @endif

                             </div>
                        </div>
                        <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                <label for="country_id" class="col-md-4 control-label">Country</label>
                            <div class="col-md-6">
                                <select id="country_id" name="country_id" class="form-control">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{$country->name }}</option>
                                @endforeach
                               </select>

                               @if ($errors->has('country_id'))
                                  <span class="help-block">
                                 <strong>{{ $errors->first('country_id') }}</strong>
                                 </span>
                            @endif
                           </div>
                       </div>
                       <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                           <label for="phone" class="col-md-4 control-label"> Phone</label>

                           <div class="col-md-6">
                               <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                               @if ($errors->has('phone'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('phone') }}</strong>
                                   </span>
                               @endif
                           </div>
                       </div>

                     <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                         <strong>{{ $errors->first('password') }}</strong>
                                         </span>
                                         @endif
                            </div>
                    </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
