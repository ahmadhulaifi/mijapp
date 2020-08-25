<footer class="main-footer">
    <strong>Copyright &copy; <a href="www.mij.sch.id">Madrasah Istiqlal Jakarta</a>.</strong>
    All rights reserved.
    <!-- <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
    </div> -->
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/asset/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>/asset/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url(); ?>/asset/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>/asset/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>/asset/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>/asset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>/asset/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>/asset/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/asset/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>/asset/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/asset/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url(); ?>/asset/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>/asset/dist/js/demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- isi content -->
<?= $this->renderSection('script'); ?>

<script>
    $(document).ready(function() {
        // menambahkan kelas aktif di sidebar
        let tes = $(".sub_menu.active").parent().parent().prev().addClass('active')

        // delete menu
        $(".deletemenu").click(function() {
            event.preventDefault()
            let idmenu = $(this).parents("tr").attr("id");

            Swal.fire({
                title: 'Apa kamu yakin untuk menghapusnya?',
                text: "kamu tidak akan bisa mengembalikannya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('/menu/deletemenu'); ?>/' + idmenu,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $("#" + idmenu).remove();
                            Swal.fire(
                                'Deleted!',
                                'File sudah terdelete.',
                                'success'
                            )
                        }
                    });

                }
            })

        })

        // delete submenu
        $(".deletesubmenu").click(function() {
            event.preventDefault()
            let idsub = $(this).parents("tr").attr("id");

            Swal.fire({
                title: 'Apa kamu yakin untuk menghapusnya?',
                text: "kamu tidak akan bisa mengembalikannya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('/menu/deletesubmenu'); ?>/' + idsub,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $("#" + idsub).remove();
                            Swal.fire(
                                'Deleted!',
                                'File sudah terdelete.',
                                'success'
                            )

                        }
                    });

                }
            })
        })

        // delete role
        $(".deleterole").click(function() {
            event.preventDefault()
            let idrole = $(this).parents("tr").attr("id");

            Swal.fire({
                title: 'Apa kamu yakin untuk menghapusnya?',
                text: "kamu tidak akan bisa mengembalikannya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('/role/deleterole'); ?>/' + idrole,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $("#" + idrole).remove();
                            Swal.fire(
                                'Deleted!',
                                'File sudah terdelete.',
                                'success'
                            )

                        }
                    });

                }
            })

        })

    });
</script>
</body>

</html>