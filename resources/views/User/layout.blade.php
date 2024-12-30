<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #F9FAFB;
        }
        .sidebar {
            background-color: #1E293B;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 16rem;
            z-index: 40;
        }
        .main-content {
            margin-left: 16rem;
            min-height: 100vh;
            background-color: #F9FAFB;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
