<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->


        <div class="row">
            <input name="role_kode_hidden" type="hidden" value="<?= session('role_kode'); ?>">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title">Kelas Asal</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="form_kelas_asal">
                            <div class="form-group row">
                                <label for="rombelasal" class="col-sm-2 col-form-label">Rombel</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="rombelasal" name="rombelasal">
                                        <option disabled selected>-- Pilih Rombel --</option>
                                        <option value="belum">Belum Diatur</option>
                                        <?php foreach ($rombelasal as $rombelasal) : ?>
                                            <option value="<?= $rombelasal['id']; ?>"><?= $rombelasal['rombel']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="iddivisicekasal" id="iddivisicekasal" value="<?= $divisi['id']; ?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" id="btncekkelasasal" class="btn btn-primary">Cek</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped" id="tableKelasAsal">
                                <thead class="bg-success">
                                    <tr>
                                        <th><input type="checkbox" id='checkall'></th>
                                        <!-- <th scope="col">No</th> -->
                                        <th scope="col">NIK</th>
                                        <!-- <th scope="col">NISN</th> -->
                                        <th scope="col">Nama</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title">Kelas Tujuan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="form_kelas_tujuan">
                            <div class="form-group row">
                                <label for="rombeltujuan" class="col-sm-2 col-form-label">Rombel</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="rombeltujuan" name="rombeltujuan">
                                        <option disabled selected>-- Pilih Rombel --</option>
                                        <option value="belum">Belum Diatur</option>
                                        <?php foreach ($rombeltujuan as $rombeltujuan) : ?>
                                            <option value="<?= $rombeltujuan['id']; ?>"><?= $rombeltujuan['rombel']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="iddivisicektujuan" id="iddivisicektujuan" value="<?= $divisi['id']; ?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" id="btncekkelastujuan" class="btn btn-primary">Cek</button>
                        </form>

                        <a id="btnpindahkelas" class="btn btn-warning"><i class="fas fa-fw  fa-arrow-circle-right"></i>Pindah Kelas Tujuan</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="tableKelasTujuan">
                        <thead class="bg-success">
                            <tr>
                                <th>No</th>
                                <!-- <th scope="col">No</th> -->
                                <th scope="col">NIK</th>
                                <!-- <th scope="col">NISN</th> -->
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <!-- /.card-body -->
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

        function tabelkelasasal(dataks) {
            $('#tableKelasAsal').DataTable({
                "data": dataks,
                "responsive": true,
                "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-3'><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                "columns": [

                    {
                        targets: 0,
                        data: null,
                        className: 'text-center',
                        searchable: false,
                        orderable: false,


                        "render": function(data, type, row, meta) {
                            var r =
                                '<input type="checkbox" name="checkbox" id = "' + row.id + '"  value = "' + row.id + '" class="pindah_checkbox"></input>';

                            return r;
                        },
                    },
                    {
                        "data": "nik"
                    },


                    {
                        "data": "nama_lengkap"
                    },

                ]
            });
        }

        function tabelkelastujuan(dataks) {
            let i = 1;
            $('#tableKelasTujuan').DataTable({
                "data": dataks,
                "responsive": true,
                "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-3'><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                "columns": [

                    {
                        "data": null,
                        "render": function() {
                            return a = i++;
                        }
                    },
                    {
                        "data": "nik"
                    },


                    {
                        "data": "nama_lengkap"
                    },

                ]
            });
        }

        $("#form_kelas_asal").submit(function(event) {
            event.preventDefault();
            // console.log($(this).serialize());
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/fetchsiswakelasasal',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btncekkelasasal').attr('disabled');
                    $("#btncekkelasasal").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        // console.log(data.cekrombel);
                        $('#tableKelasAsal').DataTable().destroy();
                        tabelkelasasal(data.siswa);
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                        // console.log(data);
                    }
                },
                complete: function() {
                    $('#btncekkelasasal').removeAttr('disabled');
                    $("#btncekkelasasal").html(`Cek`);

                },
            });
        });

        $("#form_kelas_tujuan").submit(function(event) {
            event.preventDefault();
            // console.log($(this).serialize());
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/fetchsiswakelastujuan',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btncekkelastujuan').attr('disabled');
                    $("#btncekkelastujuan").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        // console.log(data.cekrombel);
                        $('#tableKelasTujuan').DataTable().destroy();
                        tabelkelastujuan(data.siswa);
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                        // console.log(data);
                    }
                },
                complete: function() {
                    $('#btncekkelastujuan').removeAttr('disabled');
                    $("#btncekkelastujuan").html(`Cek`);

                },
            });
        });

        // Check all 
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.pindah_checkbox').prop('checked', true);
            } else {
                $('.pindah_checkbox').prop('checked', false);
            }
        });

        $('.pindah_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });

        $('#btnpindahkelas').click(function() {

            let checkbox = $('.pindah_checkbox:checked');
            let rombelasal = $('#rombelasal').val();
            let rombeltujuan = $('#rombeltujuan').val();

            if (checkbox.length > 0) {
                Swal.fire({
                    title: 'Apa kamu yakin ingin memindahkan ' + checkbox.length + ' siswa ke kelas tujuan?',
                    text: "kamu akan bisa mengembalikannya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, pindahkan saja!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var checkbox_value = [];
                        $(checkbox).each(function() {
                            checkbox_value.push($(this).val());
                        });

                        // console.log(checkbox);
                        $.ajax({
                            url: '<?= base_url('/tatausaha/pindahkelassiswa'); ?>',
                            type: "POST",
                            data: {
                                checkbox_value: checkbox_value,
                                rombelasal: rombelasal,
                                rombeltujuan: rombeltujuan
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.responce == "success") {
                                    // toastr["success"](data.pesan);
                                    Swal.fire(
                                        'Berhasil!',
                                        'Siswa berhasil dipindah.',
                                        'success'
                                    )
                                    $('#tableKelasAsal').DataTable().destroy();
                                    $('#tableKelasTujuan').DataTable().destroy();
                                    tabelkelasasal(data.siswaasal);
                                    tabelkelastujuan(data.siswatujuan);
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
        });



    });
</script>

<?= $this->endSection(); ?>