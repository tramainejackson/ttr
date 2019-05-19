<footer class="black d-flex justify-content-center align-items-center py-3">

	<div class="col-12 col-md-8 col-xl-6" id="">

		<!-- Contact form -->
		{!! Form::open(['action' => ['MessagesController@store'], 'method' => 'POST']) !!}
			<p class="h4 text-center mb-4 white-text">Write to us</p>

			<!-- input text -->
			<div class="md-form">
				<i class="fas fa-user prefix white-text"></i>
				<input type="text" name="contact_name" id="contact_name" class="form-control white-text">
				<label for="contact_name">Your name</label>
			</div>

			<!-- input email -->
			<div class="md-form">
				<i class="fas fa-envelope prefix white-text"></i>
				<input type="email" name="contact_email" id="contact_email" class="form-control white-text">
				<label for="contact_email">Your email</label>
			</div>

			<!-- input subject -->
			<div class="md-form">
				<i class="fas fa-tag prefix white-text"></i>
				<input type="text" name="contact_subject" id="contact_subject" class="form-control white-text">
				<label for="contact_subject">Subject</label>
			</div>

			<!-- textarea message -->
			<div class="md-form">
				<i class="fas fa-pencil-alt prefix white-text"></i>
				<textarea type="text" name="contact_message" id="contact_message" class="form-control white-text md-textarea" rows="3"></textarea>
				<label for="contact_message">Your message</label>
			</div>

			<div class="text-center mt-4">
				<button class="btn btn-outline-secondary w-auto" type="submit">Send <i class="fas fa-paper-plane"></i></button>
			</div>
		{!! Form::close() !!}
		<!-- Contact form -->

	</div>
</footer>