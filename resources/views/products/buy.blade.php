@include('layouts.header')
@if(session('success'))
<div class="bg-green-500 text-white p-4 rounded">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-500 text-white p-4 rounded">
    {{ session('error') }}
</div>
@endif

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="https://placehold.co/400?text={{$product->name}}" alt="{{ $product->name }}" class="product-image">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p>Price: ${{ $product->price }}</p>

            <form id="payment-form" action="{{ route('products.charge', $product->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="card-element">Credit or Debit Card</label>
                    <div id="card-element" class="form-control"></div>
                    <div id="card-errors" role="alert"></div>
                </div>
                <button type="submit" class="btn btn-primary">Buy Now</button>
            </form>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        }).then(function(result) {
            if (result.error) {
                document.querySelector('.error-message').innerText = result.error.message;
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethodId');
                hiddenInput.setAttribute('value', result.paymentMethod.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    });
</script>
@include('layouts.footer')
