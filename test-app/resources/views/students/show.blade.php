<!DOCTYPE html>
<html>
<head>
    <title>Jwelery Details</title>
</head>
<body>
    <h1> {{ $Jwelery['name'] }}</h1>

    <p><strong>Price:</strong> {{ $Jwelery['price'] }}</p>
    <p><strong>Description:</strong> {{ $jwelery['Description'] }}</p>
    <a href="{{ route('Jwelery.index') }}">Back to Jwelery List</a>
</body>
</html>
