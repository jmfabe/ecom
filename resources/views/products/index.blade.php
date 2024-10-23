@include('layouts.header')

<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h2 class="text-center mb-4">Our Products</h2>
    <div class="row">

        @foreach ($products as $item)
        <div class="col-md-4">
            <div class="product-card">
                <img src="https://placehold.co/400?text={{$item->name}}" alt="Product 1">
                <h5 class="mt-3">{{$item->name}}</h5>
                <p class="price">${{$item->price}}</p>
                <a href="{{ route('products.buy', ['id'=>$item->id]) }}" class="btn btn-primary">Buy Now</a>
            </div>
        </div>
        @endforeach


    </div>
</div>

@include('layouts.footer')
