<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>



    <div class="container my-5">

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
