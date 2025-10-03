<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    

</head>
<body class="flex flex-col min-h-screen">

    <div class="d-flex flex-grow-1">
        
        <div class="bg-white border border-gray-200">
            @include('layouts.sidebar')
        </div>
        {{-- Konten --}}
        <div class="flex-grow-1 d-flex flex-column">
            @include('layouts.navbar')

            {{-- Content --}}
            <main class="container-fluid mt-4 flex-grow-1">
                <div class="bg-white p-3">
                    @yield('content')
                </div>
            </main>
            {{-- Footer --}}
            <footer class="mt-aut text-center py-3 text-gray-600 text-sm">
                @include('layouts.footer')
            </footer>
        </div>
    </div>


    <!-- Bootstrap JS & AlpineJS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/search.js') }}"></script>
</body>
</html>
