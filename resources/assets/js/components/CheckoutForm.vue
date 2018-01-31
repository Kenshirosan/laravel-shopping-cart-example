<template>
        <div>
            <button>Submit Payment</button>
        </div>
</template>

<script>
    export default {
        mounted() {
            // Create a Stripe client
            var stripe = Stripe('pk_test_B9SEClbQcg35eUmOyH4adj7M');

            // Create an instance of Elements
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                      color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission
            var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                event.preventDefault();
                // create source instead of token for 3d secure payment
                // stripe.createSource({
                //     type: 'three_d_secure',
                //     amount: 1099,
                //     currency: "eur",
                //     three_d_secure: {
                //     card: card.id
                //     },
                //     redirect: {
                //         return_url: "http://127.0.0.1:8000/checkout"
                //     }
                // }).then(function(result) {
                //     // handle result.error or result.source
                //     return console.log(result);
                //     });
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                  // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    } else {
                      // Send the token to your server
                      // return console.log(result.token);
                      stripeTokenHandler(result.token);
                    }
                });
            });
        }
    }
</script>

<style>
.StripeElement {
  background-color: white;
  height: 40px;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>