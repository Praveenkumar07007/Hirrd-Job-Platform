<!DOCTYPE html>
<html>
<head>
    <title>Jwelery List</title>
</head>
<body>
    <h1>Jwelery List</h1>
    <ul>
        @foreach ($jwelery as $jwelery)
            <li>
                <a href="{{ route('jwelery.show', $jwelery['id']) }}">
                    {{ $jwelery['name'] }} (price: {{ $jwelery['price'] }})
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
