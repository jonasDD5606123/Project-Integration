<style>
    .header {
        background: linear-gradient(90deg, #d32f2f, #f44336);
    }
</style>

<header class="header navbar navbar-expand-lg navbar-dark bg-danger py-4 px-5 rounded-bottom shadow-sm w-full" role="banner">
    <div>
        <h1 class="h4 mb-0 text-white">
            {{ Auth::user()->name }}
        </h1>
        <a href="{{ url('/') }}" class="btn btn-light fw-semibold" role="button" aria-label="Terug naar home">
            ← Terug
        </a>
    </div>
</header>