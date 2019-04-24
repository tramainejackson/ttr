@extends('layouts.app')

@section('scripts')
    <script type="text/javascript">
        $('nav.navbar').addClass('fixed-top scrolling-navbar');
        $('.loginContainer').css({'paddingTop' : ($('nav.navbar').height() + 20) + 'px'});
    </script>
@endsection

@section('content')

    <div class="" style="background-image: url('/images/login_page_pic.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">

        <div class="mask rgba-black-strong d-flex justify-content-center align-items-center py-5">

            <div class="container loginContainer">

                <div class="row">

                    <div class="col-12 col-xl-8 mt-5 mt-xl-0">

                        <div class="card wow fadeInLeft" data-wow-delay="0.3s">

                            <div class="card-body">

                                <div class="text-center">
                                    <h1 class="font-weight-bold h1-responsive text-underline">Reset Password</h1>
                                </div>


                                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">

                                        <i class="far fa-envelope prefix grey-text"></i>

                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">

                                        <i class="fas fa-lock prefix grey-text"></i>

                                        <input id="password" type="password" class="form-control" name="password" required>

                                        <label for="password" class="col-md-4 control-label">Password</label>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="md-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                        <i class="fas fa-lock prefix red-text"></i>

                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="md-form">
                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-4 mt-3 mt-xl-0">
                        <div class="wow fadeInRight" data-wow-delay="0.3s">
                            <div class="forgotPassword text-center">
                                <h1 class="white-text">This thingy is broken!</h1>
                            </div>
                            <div class="white-text">
                                <p class="mt-3">If are still having issues resetting you're password, please send us an email at the link below.</p>

                                <div class="mb-3">
                                    <a href="mailTo:totherec@gmail.com" class="btn btn-lg red lighten-1 d-block">totherec@gmail.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
