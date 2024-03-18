<x-layouts.auth title="Daftar">
    <h5 class="fw-bold">Verifikasi OTP</h5>
    <form action="{{ route('auth.verify.store') }}" method="POST" class="mt-4">
        @csrf
        <x-forms.input type="text" name="otp" placeholder="Kode OTP" class="py-2" id="otp" />
        <x-ui.base-button class="w-100 mt-32 py-2" type="submit" color="primary" id="btn-verify">
            Verifikasi
        </x-ui.base-button>
    </form>

    @push('script')
        <script>
            const btnVerify = document.querySelector('#btn-verify');
            const form = document.querySelector('form');

            btnVerify.addEventListener('click', function() {
                btnVerify.innerHTML = `<i class="fas fa-circle-notch fa-spin"></i>`;
                btnVerify.disabled = true;
                form.submit();
            });
        </script>
    @endpush
</x-layouts.auth>
