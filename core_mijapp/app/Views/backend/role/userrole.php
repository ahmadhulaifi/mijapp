<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<script>
    /**
     * Get Destination Data From Class Group Settings
     */
    function getFromTargetList() {
        $('.destination-class-overlay').show();


        $('.destination-class-overlay').hide();
    }
</script>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="">
                            <div class="form-group row">
                                <label for="roleasal" class="col-sm-4 col-form-label">Role Asal</label>
                                <div class="col-sm-8">
                                    <select name="roleasal" id="roleasal" class="form-control">
                                        <option value="semua" selected>Tampilkan semua</option>
                                        <?php foreach ($role as $role) : ?>
                                            <option value="<?= $role['role_kode']; ?>"><?= $role['role']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <form action="">
                            <div class="form-group row">
                                <label for="roletujuan" class="col-sm-4 col-form-label">Role Tujuan</label>
                                <div class="col-sm-8">
                                    <select name="roletujuan" id="roletujuan" class="form-control">
                                        <option selected disabled>Tampilkan semua</option>
                                        <?php foreach ($role2 as $rol) : ?>
                                            <option value="<?= $rol['role_kode']; ?>"><?= $rol['role']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-sm btn-primary" id="btntujuanrolepegawai"><i class="fa fa-arrow-right"></i> Edit Role Tujuan</button>
                    </div>


                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed" id="tableRole">
                                <thead class="bg-success">
                                    <tr>
                                        <th><input type="checkbox" id='checkall'></th>
                                        <!-- <th scope="col">No</th> -->
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Role</th>

                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="overlay asal-divisi-overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>

            </div>
        </div>



    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function() {

        function tabelrole(dataks) {
            $('#tableRole').DataTable({
                "data": dataks,
                "responsive": true,
                "dom": "<'row'<'col-sm-12 col-md-7'l><'col-sm-12 col-md-4'f><'col-sm-12 col-md-1'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="far fa-fw fa-file-excel"></i>',
                    titleAttr: 'Excel'
                }],

                "columns": [

                    {
                        targets: 0,
                        data: null,
                        className: 'text-center',
                        searchable: false,
                        orderable: false,

                        "render": function(data, type, row, meta) {
                            var r =
                                '<input type="checkbox" name="checkbox" id = "' + row.id + '"  value = "' + row.id + '" class="select_checkbox"></input>';

                            return r;
                        },
                    },

                    {
                        "data": "nip"
                    },
                    {
                        "data": "nama_lengkap"
                    },
                    {

                        "data": 'role_kode',

                        "render": function(data, type, row, meta) {


                            let a = '';
                            if (data == null) {
                                a = ''
                            } else {
                                // for (let i = 0; i < data.length; i++) {
                                //     a += `<span class="badge badge-info">` + data + `</span>`
                                // };
                                a = `<span class="badge badge-info">` + data + `</span>`
                            }
                            return a
                        }
                    }

                ]
            });
        }



        //fetch Role semua
        function fetchRoleSemua() {
            $.ajax({
                url: '<?= base_url(); ?>/role/fetchrolesemuapegawai',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data.pegawai);
                    let i = "1";
                    tabelrole(data.rolepegawai)
                }
            });
        }

        fetchRoleSemua();




        $("#roleasal").change(function() {
            let roleasal = $("#roleasal").val();
            if (roleasal == 'semua') {
                $('.asal-divisi-overlay').show();
                $('#tableRole').DataTable().destroy();
                fetchRoleSemua();
                $('.asal-divisi-overlay').hide();
            } else {
                // console.log(divisiasal)
                $('.asal-divisi-overlay').show();
                $('#tableRole').DataTable().destroy();
                $.ajax({
                    url: "<?= base_url(); ?>/role/fetchfilterrolepegawai",
                    type: "post",
                    data: {
                        roleasal: roleasal
                    },
                    async: true,
                    dataType: "json",

                    success: function(data) {
                        // console.log(data.satuan)
                        if (data.responce == 'success') {
                            // console.log(data.responce)
                            tabelrole(data.rolepegawai)
                        } else {
                            // console.log(data.responce)
                            $('#tableRole').DataTable().clear();
                            $('#tableRole').DataTable().destroy();
                        }
                    }
                });


                $('.asal-divisi-overlay').hide();
            }
        })

        // Check all 
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.select_checkbox').prop('checked', true);
            } else {
                $('.select_checkbox').prop('checked', false);
            }
        });

        $('.select_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });



        $('#btntujuanrolepegawai').click(function() {
            let checkbox = $('.select_checkbox:checked');
            let idroletujuan = $("#roletujuan").val();

            if (idroletujuan == null) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih divisi tujuan dulu',
                })
            } else {
                if (checkbox.length > 0) {
                    Swal.fire({
                        title: 'Apa kamu yakin ingin megubah ' + checkbox.length + ' data akses pegawai?',
                        text: "kamu bisa menggantinya lagi kembali nanti!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, tambahkan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let checkbox_value = [];
                            $(checkbox).each(function() {
                                checkbox_value.push($(this).val());
                            });

                            // console.log(checkbox);
                            $.ajax({
                                url: '<?= base_url('/role/btntujuanrolepegawai'); ?>',
                                type: "POST",
                                data: {
                                    checkbox_value: checkbox_value,
                                    idroletujuan: idroletujuan
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.responce == "success") {
                                        Swal.fire(
                                            'Sukses!',
                                            'Data akses berhasil diupdate.',
                                            'success'
                                        )
                                        $('#tableRole').DataTable().destroy();
                                        fetchRoleSemua();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Ada yang tidak beres!',
                                        })
                                    }
                                }
                            })

                        }
                    })

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih minimal satu data',
                    })

                }
            }


        });


    })
</script>

<?= $this->endSection(); ?>