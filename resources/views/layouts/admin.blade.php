<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - {{ config('app.name') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @stack('styles')
</head>
<style>
    .hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
    display: none;
}
</style>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark text-white" id="sidebar-wrapper" style="width: 250px;">
            <div class="sidebar-heading text-center py-4">
                <h4>{{ config('app.name') }}</h4>
                <p class="mb-0">Admin Panel</p>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-box me-2"></i>Products
                </a>
                <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-list me-2"></i>Categories
                </a>
                <a href="{{ route('admin.documents.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-file-alt me-2"></i>Documents
                </a>
                <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <i class="fas fa-shopping-cart me-2"></i>Orders
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper" style="width: calc(100% - 250px);">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-sm btn-dark" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid px-4 py-3">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar
            document.getElementById('menu-toggle').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar-wrapper');
                const content = document.getElementById('page-content-wrapper');
                
                if (sidebar.style.display === 'none') {
                    sidebar.style.display = 'block';
                    content.style.width = 'calc(100% - 250px)';
                } else {
                    sidebar.style.display = 'none';
                    content.style.width = '100%';
                }
            });

            // Auto-hide sidebar on small screens
            function handleResize() {
                const sidebar = document.getElementById('sidebar-wrapper');
                const content = document.getElementById('page-content-wrapper');
                
                if (window.innerWidth < 768) {
                    sidebar.style.display = 'none';
                    content.style.width = '100%';
                } else {
                    sidebar.style.display = 'block';
                    content.style.width = 'calc(100% - 250px)';
                }
            }

            window.addEventListener('resize', handleResize);
            handleResize(); // Initial call
        });
    </script>
    
    @stack('scripts')
</body>
</html>