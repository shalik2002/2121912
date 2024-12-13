<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        nav {
            background-color: #007BFF;
            padding: 1rem;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 1rem;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #0056b3;
        }

        header {
            text-align: center;
            margin-top: 2rem;
        }

        header h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            color: #007BFF;
        }

        header p {
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            @foreach ($navItems as $name => $url)
                <li><a href="{{ $url }}">{{ $name }}</a></li>
            @endforeach
        </ul>
    </nav>
    <header>
        <h1>Welcome to the Blog</h1>
        <p>Your go-to platform for exciting articles and insights</p>
    </header>
</body>
</html>
