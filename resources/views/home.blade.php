@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>

						<form name="testForm" class="testForm" method="POST">
							<input type="file" name="file" class="" value="" />
							<button class="btn blue submitTest" type="submit">Submit</button>
						</form>
					
						<div class="progress">
							<div class="progress-bar" id="pro" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
