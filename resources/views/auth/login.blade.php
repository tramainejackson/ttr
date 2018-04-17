@extends('layouts.app')

@section('additional_scripts')
	<script type="text/javascript">
		$('nav.navbar').addClass('fixed-top scrolling-navbar');
	</script>
@endsection

@section('content')
	<div class="view" style="background-image: url('/images/login_page_pic.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
		<div class="mask rgba-black-strong d-flex justify-content-center align-items-center">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="card wow fadeInLeft" data-wow-delay="0.3s">
							<div class="card-body">
								<div class="text-center">
									<h1 class="font-weight-bold h1-responsive text-underline">Login</h1>
								</div>

								<div class="">
									{!! Form::open(['route' => ['login'], 'method' => 'POST']) !!}
										<div class="md-form">
											<i class="fa fa-user prefix grey-text"></i>
											
											<input type="text" class="form-control" name="username" id="username" />
											
											<label for="username">Username</label>
										</div>
										
										@if($errors->has('username'))
											<!--Username/Password Combination error message-->
											<div class="m-3">
												<span class="red-text">That username/password combination was not found. Please try again.</span>
											</div>
										@endif
										
										<div class="md-form">
											<i class="fa fa-lock prefix grey-text"></i>
											
											<input type="password" class="form-control" id="password" name="password" />
											
											<label for="password">Password</label>
										</div>
										<div class="md-form">
											<button type="submit" class="btn btn-lg deep-orange white-text ml-0">Sign me in</button>
										</div>
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="wow fadeInRight" data-wow-delay="0.3s">
							<div class="forgotPassword text-center">
								<h1 class="white-text">Welcome Back!</h1>
							</div>
							<div class="white-text">
								<p class="mt-3">Having issues logging in? Click forgot password or you can email us here with any questions.</p>
								
								<div class="mb-3">
									<a href="mailTo:totherec@gmail.com" class="btn btn-lg primary-color-dark d-block">totherec@gmail.com</a>
								</div>
								
								<div class="">
									<a href="{{ route('password.request') }}" class="btn btn-lg red darken-2 d-block">Reset Password</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
