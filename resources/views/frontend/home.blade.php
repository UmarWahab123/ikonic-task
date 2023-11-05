<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     @php $setting = get_settings() @endphp
    <title>{{ optional($setting)->site_name }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/' . optional($setting)->favicon) }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('assets/css/product.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    @include('frontend.header')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
             @foreach ($products as $product)
                <a href="{{ url('/product-detail',['product_id' => $product->id]) }}">
                <div class="product-card">
                    <img src="{{ asset('img/' . @$product->product_image) }}" alt="Product 1" class="product-image img-fluid">
                    <div class="card-body">
                        <h5 class="product-title">{{ @$product->product_title }}</h5>
                        <p class="product-price">{{ @$product->product_price }}</p>
                    </div>
                </div>
                </a>
              @endforeach
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
