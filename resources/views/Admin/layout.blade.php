<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="h-full bg-gray-100 antialiased">
    @yield('content')

    <!-- Toast Notification Container -->
    <div class="fixed bottom-4 right-4 z-50">
        <!-- Success Toast -->
        @if(session('success'))
        <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <div class="text-sm font-medium">{{ session('success') }}</div>
            <button type="button" 
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-100 inline-flex items-center justify-center h-8 w-8" 
                    onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        <!-- Error Toast -->
        @if(session('error'))
        <div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <div class="text-sm font-medium">{{ session('error') }}</div>
            <button type="button" 
                    class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-100 inline-flex items-center justify-center h-8 w-8" 
                    onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
    </div>
</body>

</html>
