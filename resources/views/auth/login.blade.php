<x-guest-layout>

    <div style="margin-bottom:24px;">
        <h1 class="auth-form-title">Bienvenido de vuelta</h1>
        <p class="auth-form-sub">Inicia sesión para acceder al sistema</p>
    </div>

    <x-auth-session-status
        class="sst-alert sst-alert-info mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email" class="input-label">Correo electrónico</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="sst-input {{ $errors->has('email') ? 'error' : '' }}"
                placeholder="correo@empresa.com"
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
                <div class="input-error">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                <label for="password" class="input-label" style="margin-bottom:0;">Contraseña</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       style="font-size:12.5px;color:var(--primary-600);text-decoration:none;"
                       onmouseover="this.style.textDecoration='underline'"
                       onmouseout="this.style.textDecoration='none'">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <input
                id="password"
                type="password"
                name="password"
                class="sst-input {{ $errors->has('password') ? 'error' : '' }}"
                placeholder="••••••••"
                required
                autocomplete="current-password"
            >
            @error('password')
                <div class="input-error">
                    <i class="bi bi-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div style="margin-bottom:20px;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;user-select:none;">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    style="width:15px;height:15px;accent-color:var(--primary-600);cursor:pointer;"
                >
                <span style="font-size:13.5px;color:var(--text-secondary);">Recordarme</span>
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;height:42px;font-size:14px;">
            <i class="bi bi-box-arrow-in-right"></i>
            Iniciar sesión
        </button>

    </form>

</x-guest-layout>
