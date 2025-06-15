<style>
    .header {
        background: linear-gradient(90deg, #d32f2f, #f44336);
    }
</style>

<header class="header main-header" role="banner">
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
        <h1 class="h4 mb-0 text-white" style="margin: 0;">
            {{ auth()->user()->voornaam }}
        </h1>

        <a href="{{ url('/') }}" class="btn-back" role="button" aria-label="Terug naar home">
            ← Terug
        </a>
    </div>
</header>