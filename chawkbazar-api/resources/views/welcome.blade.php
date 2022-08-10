<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Marvel Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">


    <!-- Styles -->
    <style>
        .welcome {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .welcome h1 {
            font-family: 'Raleway', sans-serif;
            font-size: 40px;
            font-weight: 300;
            color: #333333;
            margin-bottom: 30px;
        }

        .welcome ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .welcome ul li {
            margin-right: 30px;
        }

        .welcome ul li:last-child {
            margin-right: 0px;

        }

        .welcome ul li a {
            font-family: system-ui, ui-sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 14px;
            color: #222222;
            text-decoration: none;
            transition: color 0.3s;
            text-transform: uppercase;
        }

        .welcome ul li a:hover {
            color: #009f7f;
        }

        .welcome ul li a:foucs {
            outline: none;
        }

        /* Put css here */
    </style>
</head>

<body class="welcome">
    <h1>Marvel Laravel</h1>
    <ul>
        <li><a href="https://pickbazarapi.redq.io/shop/playground">GraphQL Playground</a></li>
        <li><a href="https://pickbazar-doc.vercel.app/">Documentation</a></li>
        <li><a href="http://redqsupport.ticksy.com/">Support</a></li>
        <li><a href="https://redq.io/">Contact</a></li>
    </ul>
</body>

</html>