<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <style>
        .product-btn {
            background-color: black;
            padding: 0.25rem 1rem;
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: 400;
            border-radius: 0.2rem;
        }
    </style>
</head>

<body>



    <div class="container my-5">


        @if (session()->has('success'))
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                </div>
            </div>
        @endif


        @if (auth()->user()->is_admin)
            <div class="row mb-5">
                <div class="col-md-4">
                    <a href="{{ route('products.create') }}" class="product-btn">Add Product</a>
                </div>
            </div>
        @endif

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="card-body" style="min-height: 12rem;">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $product->price }} EGP</h6>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $product->euro_price }} Euro</h6>
                            <p class="card-text">{{ $product->description }}</p>
                        </div>


                        @if (auth()->user()->is_admin)
                            <div class="card-footer">
                                <a href="{{ route('products.edit', $product->id) }}" class="product-btn">Edit</a>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <h2>No Products Found ... </h2>
            @endforelse


        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>

</body>

</html>
