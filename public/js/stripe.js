
      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
      data-key="{{ config('services.stripe.key') }}"
      data-amount="{{ Cart::total() }}"
      data-name="Demo Site"
      data-description="Widget"
      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
      data-locale="auto"
      data-currency="usd"
      data-zip-code="true">
  </script>