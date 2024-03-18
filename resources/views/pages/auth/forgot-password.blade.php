<x-layouts.auth title="Lupa Password">
    <h5 class="fw-bold">Lupa Password</h5>
    <p id="description">Silahkan masukkan email kamu untuk mendapatkan kode OTP</p>


    <div class="alert alert-danger d-none" id="error-alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle me-2"></i>
            <span id="error-message"></span>
        </div>
    </div>

    <div class="alert alert-success d-none" id="success-alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            <span id="success-message"></span>
        </div>
    </div>

    <form id="email-form" class="mt-4 d-block">
        @csrf
        <x-forms.input type="text" name="email" placeholder="Email" class="py-2" id="email" />
        <x-ui.base-button class="w-100 mt-32 py-2" type="submit" color="primary" id="btn-submit">
            Kirim
        </x-ui.base-button>
    </form>

    <form id="otp-form" class="mt-4 d-none">
        @csrf
        <x-forms.input type="text" name="otp" placeholder="Kode OTP" class="py-2" id="otp" />
        <x-ui.base-button class="w-100 mt-32 py-2" type="submit" color="primary" id="btn-verify">
            Verifikasi
        </x-ui.base-button>
    </form>

    <form id="password-form" class="mt-4 d-none">
        @csrf
        <x-forms.input type="password" name="password" placeholder="Password" class="py-2" id="password" />
        <x-forms.input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="py-2"
            id="password_confirmation" />
        <x-ui.base-button class="w-100 mt-32 py-2" type="submit" color="primary" id="btn-submit-password">
            Simpan
        </x-ui.base-button>
    </form>

    @push('script')
        <script>
            $(document).ready(function() {
                const emailForm = $('#email-form');
                const otpForm = $('#otp-form');
                const passwordForm = $('#password-form');

                const btnSubmit = $('#btn-submit');
                const btnVerify = $('#btn-verify');
                const btnSubmitPassword = $('#btn-submit-password');
                const btnLogin = $('#btn-login');

                const email = $('#email');
                const otp = $('#otp');
                const password = $('#password');
                const passwordConfirmation = $('#password_confirmation');

                const errorMessage = $('#error-message');
                const errorAlert = $('#error-alert');

                const successMessage = $('#success-message');
                const successAlert = $('#success-alert');

                const description = $('#description');

                btnSubmit.on('click', function() {
                    btnSubmit.html('<i class="fas fa-circle-notch fa-spin"></i>');
                    btnSubmit.prop('disabled', true);

                    $.ajax({
                        url: '{{ route('api.auth.forgot-password') }}',
                        method: 'POST',
                        data: {
                            email: email.val(),
                        },
                        success: function(response) {
                            btnSubmit.html('Kirim');
                            btnSubmit.prop('disabled', false);

                            localStorage.setItem('email', email.val());

                            if (response.success === true) {
                                emailForm.addClass('d-none');
                                otpForm.removeClass('d-none');

                                successMessage.html(response.message);
                                successAlert.removeClass('d-none');

                                description.html(
                                    `Masukkan kode OTP yang telah dikirim ke email <b>${email.val()}</b>`
                                    );
                            }

                            if (response.success === false) {
                                errorMessage.html(response.message);
                                errorAlert.removeClass('d-none');

                                localStorage.removeItem('email');
                            }
                        },
                        error: function(error) {
                            btnSubmit.html('Kirim');
                            btnSubmit.prop('disabled', false);

                            errorMessage.html(error.responseJSON.message);
                            errorAlert.removeClass('d-none');
                        }
                    });
                });

                btnVerify.on('click', function() {
                    btnVerify.html('<i class="fas fa-circle-notch fa-spin"></i>');
                    btnVerify.prop('disabled', true);

                    localStorage.setItem('otp', otp.val());

                    $.ajax({
                        url: '{{ route('api.auth.verify-otp') }}',
                        method: 'POST',
                        data: {
                            email: localStorage.getItem('email'),
                            otp: otp.val(),
                        },
                        success: function(response) {
                            btnVerify.html('Verifikasi');
                            btnVerify.prop('disabled', false);

                            if (response.success === true) {
                                otpForm.addClass('d-none');
                                passwordForm.removeClass('d-none');

                                successMessage.html(response.message);
                                successAlert.removeClass('d-none');

                                description.html(
                                    `Silahkan masukkan password baru untuk akun <b>${localStorage.getItem('email')}</b>`
                                    );
                            }

                            if (response.success === false) {
                                errorMessage.html(response.message);
                                errorAlert.removeClass('d-none');

                                localStorage.removeItem('otp');
                            }
                        },
                        error: function(error) {
                            btnVerify.html('Verifikasi');
                            btnVerify.prop('disabled', false);
                        }
                    });
                });

                btnSubmitPassword.on('click', function() {
                    btnSubmitPassword.html('<i class="fas fa-circle-notch fa-spin"></i>');
                    btnSubmitPassword.prop('disabled', true);

                    $.ajax({
                        url: '{{ route('api.auth.reset-password') }}',
                        method: 'POST',
                        data: {
                            email: localStorage.getItem('email'),
                            password: password.val(),
                            password_confirmation: passwordConfirmation.val(),
                        },
                        success: function(response) {
                            btnSubmitPassword.html('Simpan');
                            btnSubmitPassword.prop('disabled', false);

                            if (response.success === true) {
                                passwordForm.addClass('d-none');

                                successMessage.html(response.message);
                                successAlert.removeClass('d-none');

                                description.html(
                                    `Password akun <b>${localStorage.getItem('email')}</b> berhasil diubah`
                                    );

                                localStorage.removeItem('email');

                                setTimeout(() => {
                                    window.location.href = '{{ route('auth.login') }}';
                                }, 3000);

                            }

                            if (response.success === false) {
                                errorMessage.html(response.message);
                                errorAlert.removeClass('d-none');
                            }
                        },
                        error: function(error) {
                            btnSubmitPassword.html('Simpan');
                            btnSubmitPassword.prop('disabled', false);
                        }
                    });
                });
            });
        </script>
    @endpush

</x-layouts.auth>
