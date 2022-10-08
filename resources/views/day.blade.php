<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>This Day</title>
</head>
<style type="text/css">
    body {
      background-color: #00FA9A;
      font-size: 16px;
      color: #008080;
    }
    </style>
<body>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <form action="" method="get">
        @csrf
        <blockquote>
            <p>{{ $quote['body'] }}</p>    
        </blockquote>
        <figcaption>
            <p>{{ $quote['author'] }}</p> 
        </figcaption>
    </form>
</body>
</html>