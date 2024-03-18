<x-layouts.auth title="Daftar">
    <img src="{{ asset('frontend/assets/images/logo-scp.png') }}" alt="Logo SCP" class="w-24 mb-4">
    <h5 class="fw-bold">Daftar sebagai pengguna baru</h5>
    <p>Silahkan mengisi form dibawah ini untuk mendaftar</p>

    <form action="{{ route('auth.register.store') }}" method="POST" class="mt-4">
        @csrf
        <x-forms.input type="text" name="full_name" placeholder="Nama Lengkap" class="py-2" id="full_name" />
        <x-forms.input type="email" name="email" placeholder="Email" class="py-2" id="email" />
        <x-forms.input type="password" name="password" placeholder="Password" class="py-2" id="password" />
        <x-forms.input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="py-2"
            id="password_confirmation" />

        <x-ui.base-button class="w-100 mt-3 py-2" type="submit" color="primary" id="btn-register">
            Daftar
        </x-ui.base-button>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('auth.login') }}" class="text-decoration-none text-primary">Sudah punya akun?</a>
        </div>
    </form>

    @push('script')
        <script>
            const btnRegister = document.querySelector('#btn-register');
            const form = document.querySelector('form');

            btnRegister.addEventListener('click', function() {
                btnRegister.innerHTML = `<i class="fas fa-circle-notch fa-spin"></i>`;
                btnRegister.disabled = true;
                form.submit();
            });
        </script>
    @endpush
</x-layouts.auth>
