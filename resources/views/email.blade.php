<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
</head>
<body>
<h1>{{$product->title}} is add new in Store</h1>
<img src="{{asset('images/products/'.$product->image)}}">
<p>go and take a look</p>
<h4>Gombal store</h4>
</body>
</html>
