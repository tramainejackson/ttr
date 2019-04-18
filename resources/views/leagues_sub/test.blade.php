	<div class="container-fluid">
		
		<script src="https://www.paypalobjects.com/api/checkout.js"></script>

	<div id="paypal-button"></div>

	<div id="confirm" class="hidden">
		<div>Ship to:</div>
		<div><span id="recipient"></span>, <span id="line1"></span>, <span id="city"></span></div>
		<div><span id="state"></span>, <span id="zip"></span>, <span id="country"></span></div>

		<button id="confirmButton">Complete Payment</button>
	</div>

	<div id="thanks" class="hidden">
		Thanks, <span id="thanksname"></span>!
	</div>

	<script>
		paypal.Button.render({

			env: 'sandbox', // sandbox | production

			client: {
				sandbox:    'AFcWxV21C7fd0v3bYYYRCpSSRl31AHubDZKE6-PhbLOOjDE-nroXyywx',
				production: '<insert production client id>'
			},

			payment: function(data, actions) {
				return actions.payment.create({
					payment: {
						transactions: [
							{
								amount: { total: '0.01', currency: 'USD' }
							}
						]
					}
				});
			},

			// Wait for the payment to be authorized by the customer

			onAuthorize: function(data, actions) {

				// Get the payment details

				return actions.payment.get().then(function(data) {

					// Display the payment details and a confirmation button

					var shipping = data.payer.payer_info.shipping_address;

					document.querySelector('#recipient').innerText = shipping.recipient_name;
					document.querySelector('#line1').innerText     = shipping.line1;
					document.querySelector('#city').innerText      = shipping.city;
					document.querySelector('#state').innerText     = shipping.state;
					document.querySelector('#zip').innerText       = shipping.postal_code;
					document.querySelector('#country').innerText   = shipping.country_code;

					document.querySelector('#paypal-button-container').style.display = 'none';
					document.querySelector('#confirm').style.display = 'block';

					// Listen for click on confirm button

					document.querySelector('#confirmButton').addEventListener('click', function() {

						// Disable the button and show a loading message

						document.querySelector('#confirm').innerText = 'Loading...';
						document.querySelector('#confirm').disabled = true;

						// Execute the payment

						return actions.payment.execute().then(function() {

							// Show a thank-you note

							document.querySelector('#thanksname').innerText = shipping.recipient_name;

							document.querySelector('#confirm').style.display = 'none';
							document.querySelector('#thanks').style.display = 'block';
						});
					});
				});
			}

		}, '#paypal-button');

	</script>
	</div>