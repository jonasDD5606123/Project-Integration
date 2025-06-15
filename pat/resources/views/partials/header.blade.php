<header class="navbar navbar-expand-lg navbar-dark bg-danger py-4 px-5 rounded-bottom shadow-sm" role="banner">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h1 class="h4 mb-0 text-white">
            {{ Auth::user()->name }}
        </h1>
        <a href="{{ url('/') }}" class="btn btn-light fw-semibold" role="button" aria-label="Terug naar home">
            ← Terug
        </a>
    </div>
</header>
