<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
    <script>
        function test(event){
            axios.get('/api/categories').then((res) => {
                let categories = res.data
                categories.log(categories.data)  
            })
        }
    </script>
<body>
    <button type="submit" onclick="test()">Click</button>
</body>
</html>