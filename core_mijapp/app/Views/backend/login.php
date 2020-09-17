<?= $this->extend('backend/layout/template_login'); ?>

<?= $this->section('content'); ?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="<?= base_url(); ?>/asset/images/logo_madrasah.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" id="loginkaryawan">
                <?= csrf_field(); ?>
                <span class="login100-form-title">
                    Login Karyawan MIJ
                </span>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" id="username" name="username" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-fw fa-user" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-fw fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">

                    </span>
                    <a class="txt2" href="#">

                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="#">
                        <!-- Create your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let input = $('.validate-input .input100');
    $(document).ready(function() {
        $('#loginkaryawan').on('submit', function() {
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                url: '<?= base_url(); ?>/ceklogin',
                success: function(data) {
                    if (data.success == true) {
                        if (data.responce == 'not') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Username / Password anda tidak sesuai'
                            })
                        } else {
                            window.location = '<?= base_url('/dashboard'); ?>'
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Kamu berhasil login',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            // document.write(<?= base_url('/dashboard'); ?>)

                        }
                    } else {
                        if (data.validation['username'] !== '') {
                            showValidate('#username', data.validation['username']);
                        }
                        if (data.validation['password'] !== '') {
                            showValidate('#password', data.validation['password']);

                        }
                    }
                }

            });
            return false;
        });
    });

    $('.validate-form .input100').each(function() {
        $(this).focus(function() {
            hideValidate(this);
        });
    });

    function showValidate(input, param) {
        let thisAlert = $(input).parent();
        $(thisAlert).addClass('alert-validate');
        $(input).parent().attr("data-validate", param);
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
    }
</script>
<?= $this->endSection(); ?>