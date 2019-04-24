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

                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="" method="POST" action="{{ route('password.email') }}">
                                    {{ csrf_field() }}

                                    <div class="md-form">

                                        <i class="far fa-envelope prefix grey-text"></i>

                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="md-form">
                                        <button type="submit" class="btn btn-primary btn-lg white-text ml-0">Send Password Reset Link</button>
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
</div>
@endsection
