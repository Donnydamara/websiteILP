<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <!-- Sidebar Toggle Button -->
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle me-3">
            <i class="fa fa-bars"></i>
        </button>



        <!-- Toggler untuk Layar Kecil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Main Navbar -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- User Information -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 text-gray-900 fw-bold">
                            {{ Auth::user()->name ?? 'Guest' }}
                        </span>
                        <img src="{{ Auth::user()->profile_photo ? asset('uploads/profile_photos/' . Auth::user()->profile_photo) : 'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg' }}"
                            class="img-profile rounded-circle" alt="Profile Picture" width="35" height="35">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ url('profile') }}">
                                <i class="fas fa-user me-2 text-gray-600"></i> Profil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2 text-gray-600"></i> Logout
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
