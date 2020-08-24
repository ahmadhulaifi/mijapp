<!--===============================================================================================-->
<script src="<?= base_url(); ?>/asset/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url(); ?>/asset/vendor/bootstrap/js/popper.js"></script>
<script src="<?= base_url(); ?>/asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url(); ?>/asset/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?= base_url(); ?>/asset/vendor/tilt/tilt.jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
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
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Kamu berhasil login',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            window.location = '<?= base_url('/dashboard'); ?>'
                            // alert('berhasil');
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
<!-- <script src="<?= base_url(); ?>/asset/js/main.js"></script> -->

</body>

</html>