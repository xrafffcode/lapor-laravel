<x-layouts.auth title="Masuk">
    <img src="{{ asset('frontend/assets/images/logo-scp.png') }}" alt="Logo SCP" class="w-24 mb-4">
    <h5 class="fw-bold">Selamat datang di Lapor 👋</h5>
    <p>Silahkan masuk untuk melanjutkan</p>

    <x-ui.base-button class="w-100 mt-4 py-2" type="button" color="light" icon="fab fa-google" icon-side="left"
        icon-color="danger" href="{{ route('auth.google') }}">
        Masuk dengan Google
    </x-ui.base-button>

    <div class="d-flex align-items-center mt-2">
        <hr class="flex-grow-1">
        <span class="mx-2">atau</span>
        <hr class="flex-grow-1">
    </div>

    <form action="{{ route('auth.login.store') }}" method="POST" class="mt-4">
        @csrf
        <x-forms.input type="email" name="email" placeholder="Email" class="py-2" />
        <x-forms.input type="password" name="password" placeholder="Password" class="py-2" id="password" />
        <input type="hidden" name="redirect" value="{{ request()->input('redirect') }}">

        <x-ui.base-button class="w-100 mt-3 py-2" type="submit" color="primary" id="btn-login">
            Masuk
        </x-ui.base-button>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('auth.register') }}" class="text-decoration-none text-primary">Belum punya akun?</a>
            <a href="{{ route('auth.forgot-password') }}" class="text-decoration-none text-primary">Lupa Password</a>
        </div>

    </form>


    @push('script')
        <script>
            const btnLogin = document.querySelector('#btn-login');
            const form = document.querySelector('form');

            btnLogin.addEventListener('click', function() {
                btnLogin.innerHTML = `<i class="fas fa-circle-notch fa-spin"></i>`;
                btnLogin.disabled = true;
                form.submit();
            });
        </script>
    @endpush
</x-layouts.auth>
