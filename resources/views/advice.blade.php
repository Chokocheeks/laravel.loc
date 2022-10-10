<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advice</title>
</head>
<style>
    body{
        background-image: url(https://www.americanoceans.org/wp-content/uploads/2021/06/shutterstock_1807037047-scaled.jpg);
        text-align: center;
    }
    h1{
        color: rgb(195, 195, 232);
        font-family: 'Open Sans', sans-serif;
    }
    div{
        background-color: aquamarine;
        font-style: italic;
        font-size: 18px;
    }
</style>
<body>
    <h1>This is my most important advice to date.</h1>
    <div>
        <form action="" method="get">
            @csrf
            <h2>{{ $advice }}</h2>
        </form>
    </div>
</body>
</html>