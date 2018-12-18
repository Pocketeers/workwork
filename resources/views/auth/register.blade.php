@extends('layouts.app')
@section('content')
<div class="panel-ww-registration panel panel-default center-block">
    <div class="panel-heading panel-heading-ww">Sign up for Workwork</div>
    <div class="panel-body">
        <a class="btn btn-block btn-ww-fb" href="redirect"><span class="wwicon" aria-hidden="true"><img src="/images/icon-fb.png" alt="">&nbsp;</span>Sign up with Facebook</a>
        <div class="signup-or-separator">
            <span class="h6 signup-or-separator--text">or sign up with your email</span>
            <hr>
        </div>
        <form role="form" method="POST" action="{{ url('/register') }}" id="myForm">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label>Your Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Joe Black">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>Your Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="joe@joeblack.com">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                <label>Phone</label>
                <input type="tel" class="form-control" name="contact" value="{{ old('contact') }}" placeholder="012 3456 7890">

                @if ($errors->has('contact'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contact') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="6+ characters or more">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label>Confirm password</label>
                <input type="password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group ww-user-type">
                <h4 class="text-center">I want to:</h4>
                <div class="btn-group btn-group-justified" data-toggle="buttons" role="group" aria-label="...">
                 <label class="btn btn-default">
                    <input type="radio" name="type" id="type0" autocomplete="off" value="employer"> Hire
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="type" id="type1" autocomplete="off" value="job_seeker"> Work
                  </label>
                </div>
                @if ($errors->has('type'))
                    <span class="help-block text-center">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block btn-ww-md" 
                id="submitBtn" onclick="restrict()">
                    Sign up
                </button>
            </div>
            <p class="text-center">By signing up, I agree to Workwork's <a href="">Terms and Conditions</a> and <a href="">Privacy Policy</a></p>
        </form>
        <hr>
        <div class="sign-in__no-account">Already have a Workwork account? <a class="btn btn-default pull-right" href="{{ url('/login') }}">Log in</a></div>
    </div>
</div>
@endsection
@section('js_plugins')
    @include('js_plugins.submit_restrict')
@stop
