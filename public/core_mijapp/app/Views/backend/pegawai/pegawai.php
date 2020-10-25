<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col mb-3">
                <!-- Button trigger modal -->
                <a href="<?= base_url(); ?>/pegawai/formtambah" type="button" class="btn btn-primary">
                    Tambah Pegawai
                </a>
                <button type="button" name="btn_deletepegawai" id="deletepegawai" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importModal">
                    Import
                </button>

                <!-- modal import -->
                <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Data Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Data -->
                                <form action="" method="POST" id="importpegawai" enctype="multipart/form-data">
                                    <div class="form_group" style="margin-bottom: 5;">
                                        <label for="">Unggah File</label>
                                        <input type="file" id="filepegawai" name="filepegawai" class="form-control">
                                    </div>
                                    <br>
                                    <p style="font-size: 15px;"><a href="<?= base_url(); ?>/asset/template/template_import_pegawai.xls">Download Template Import pegawai</a></p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnimportpegawai" class="btn btn-primary">Import</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <input name="role_kode_hidden" type="hidden" value="<?= session('role_kode'); ?>">
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped" id="tablePegawai">
                        <thead class="bg-navy">
                            <tr>
                                <th><input type="checkbox" id='checkall'></th>
                                <!-- <th scope="col">No</th> -->
                                <th scope="col">Action</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Nama Panggilan</th>
                                <th scope="col">Alamat lengkap</th>
                                <th scope="col">Alamat Domisili</th>
                                <th scope="col">Username</th>
                                <th scope="col">Akses Role</th>
                                <th scope="col">Agama</th>
                                <th scope="col">Status</th>
                                <th scope="col">No KTP</th>
                                <th scope="col">No KK</th>
                                <th scope="col">No NPWP</th>
                                <th scope="col">BPJS Tenaga Kerja</th>
                                <th scope="col">BPJS Kesehatan</th>
                                <th scope="col">Bank</th>
                                <th scope="col">No Rekening</th>
                                <th scope="col">Telepon</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tempat lahir</th>
                                <th scope="col">Tgl lahir</th>
                                <th scope="col">Tgl Bekerja</th>
                                <th scope="col">Status Pegawai</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                                <th scope="col">Last User Update</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>


        <!-- Modal Edit Password -->
        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Edit Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editpasswordform">
                            <input type="hidden" name="idpegawaipassword">
                            <div class="row">
                                <label for="Nama" class="col-sm-4">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <p id="namapassword"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputPassword3" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword4" class="col-sm-4 col-form-label">Retype-Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputPassword4" name="repassword">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
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

        //fetch Pegawai
        function fetchPegawai() {
            $.ajax({
                url: '<?= base_url(); ?>/pegawai/fetchpegawai',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    let role_kode_hidden = $("input[name='role_kode_hidden']").attr("value");;
                    $('#tablePegawai').DataTable({
                        "data": data.pegawai,
                        "responsive": true,
                        "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        "buttons": [{
                                extend: 'copyHtml5',
                                text: '<i class="far fa-fw fa-copy"></i>',
                                titleAttr: 'Copy'
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="far fa-fw fa-file-excel"></i>',
                                titleAttr: 'Excel'
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="far fa-fw fa-file-pdf"></i>',
                                titleAttr: 'Pdf'
                            },
                            {
                                extend: 'print',
                                text: '<i class="fas fa-fw fa-print"></i>',
                                titleAttr: 'Print'
                            },
                            {
                                extend: 'colvis',
                                text: '',
                                titleAttr: 'Colvis'
                            }
                        ],
                        columnDefs: [{
                            targets: [4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15, 16, 17, 19, 20, 21, 22, 23, 26, 27, 28],
                            visible: false
                        }],

                        "columns": [
                            // {
                            //     "data": null,
                            //     "render": function() {
                            //         return a = i++;
                            //     }
                            // },
                            {
                                targets: 0,
                                data: null,
                                className: 'text-center',
                                searchable: false,
                                orderable: false,


                                "render": function(data, type, row, meta) {
                                    var r =
                                        '<input type="checkbox" name="checkbox" id = "' + row.id + '"  value = "' + row.id + '" class="delete_checkbox"></input>';

                                    return r;
                                },
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';

                                    if (`${row.role_kode}` == "ADMIN" & role_kode_hidden != "ADMIN") {
                                        a = `
                                    <a href="<?= base_url(); ?>/pegawai/editformpegawai/${row.id}" class="badge badge-info editpegawai"><i class="far fa-fw fa-edit"></i></a>`;
                                    } else {
                                        a = `
                                    <a href="<?= base_url(); ?>/pegawai/editformpegawai/${row.id}" class="badge badge-info editpegawai"><i class="far fa-fw fa-edit"></i></a>
                                    <a type="button" value="${row.id}/${row.nama_lengkap}" class="badge badge-warning passwordpegawai"><i class="fas fa-fw fa-lock"></i></a>`;
                                    }

                                    return a;
                                }
                            },
                            {
                                "data": "nip"
                            },
                            {
                                "data": "nama_lengkap"
                            },
                            {
                                "data": "nama_panggilan"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    if (`${row.rt}` == "" || `${row.rw}` == "") {
                                        a = `
                                    ${row.jalan_no} ${row.desa_kel} ${row.kecamatan} ${row.kota} ${row.kd_pos}`;
                                    } else {
                                        a = `
                                    ${row.jalan_no} Rt.${row.rt}/${row.rw} ${row.desa_kel} ${row.kecamatan} ${row.kota} ${row.kd_pos}`;
                                    }

                                    return a;
                                }

                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    if (`${row.rt_domisili}` == "" || `${row.rw_domisili}` == "") {
                                        a = `
                                    ${row.jalan_no_domisili} ${row.desa_kel_domisili} ${row.kecamatan_domisili} ${row.kota_domisili} ${row.kd_pos_domisili}`;
                                    } else {
                                        a = `
                                    ${row.jalan_no_domisili} Rt.${row.rt_domisili}/${row.rw_domisili} ${row.desa_kel_domisili} ${row.kecamatan_domisili} ${row.kota_domisili} ${row.kd_pos_domisili}`;
                                    }

                                    return a;
                                }

                            },
                            {
                                "data": "username"
                            },
                            {
                                "data": "role_kode"
                            },
                            {
                                "data": "agama"
                            },
                            {
                                "data": "status"
                            },
                            {
                                "data": "no_ktp"
                            },
                            {
                                "data": "no_kk"
                            },
                            {
                                "data": "no_npwp"
                            },
                            {
                                "data": "no_bpjs_ketenagakerjaan"
                            },
                            {
                                "data": "no_bpjs_kesehatan"
                            },
                            {
                                "data": "bank"
                            },
                            {
                                "data": "no_rek"
                            },
                            {
                                "data": "telepon"
                            },
                            {
                                "data": "email"
                            },
                            {
                                "data": "j_kel"
                            },
                            {
                                "data": "tem_lahir"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {

                                    let a = tanggalindo(`${row.tgl_lahir}`);

                                    return a;
                                }

                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {

                                    let a = tanggalindo(`${row.tgl_mulai_bekerja}`);

                                    return a;
                                }

                            },
                            {
                                "data": "status_pegawai_kode"
                            },
                            {
                                "data": "jabatan_kode"
                            },
                            {
                                "data": "foto"
                            },
                            {
                                "data": "created_at"
                            },
                            {
                                "data": "updated_at"
                            },
                            {
                                "data": "last_user"
                            }

                        ]
                    });
                }
            });
        }

        fetchPegawai();

        $(document).on('click', '.passwordpegawai', function(e) {
            $("#editpasswordform")[0].reset();
            let arrayvalue = $(this).attr("value").split("/");

            let idpegawai = arrayvalue[0];
            let namapegawai = arrayvalue[1];
            // let idpegawai = $(this).attr("value")
            // alert("Id pegawai ini adalah " + idpegawai + "<br> dengan nama " + namapegawai)

            $('#passwordModal').modal('show')
            $("input[name='idpegawaipassword']").val(idpegawai);
            $("#namapassword").text(namapegawai);

        });

        // edit password
        $('#editpasswordform').submit(function() {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url('/pegawai/editpasswordpegawai'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.responce == "success") {
                        $('#passwordModal').modal('hide');
                        toastr["success"](data.pesan);
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                }
            });

        });

        // import pegawai
        $('#importpegawai').submit(function() {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url('/pegawai/importpegawai'); ?>',
                type: 'post',
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // setting a timeout
                    $('#btnimportpegawai').attr('disabled');
                    $("#btnimportpegawai").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {

                        $('#tablePegawai').DataTable().destroy();
                        fetchPegawai();
                        $('#importModal').modal('hide');
                        toastr["success"](data.pesan);
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnimportpegawai').removeAttr('disabled');
                    $("#btnimportpegawai").html(`Update`);

                },
            });

        });

        // Check all 
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.delete_checkbox').prop('checked', true);
            } else {
                $('.delete_checkbox').prop('checked', false);
            }
        });

        $('.delete_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });

        $('#deletepegawai').click(function() {

            var checkbox = $('.delete_checkbox:checked');

            if (checkbox.length > 0) {
                Swal.fire({
                    title: 'Apa kamu yakin ingin menghapus ' + checkbox.length + ' data pegawai?',
                    text: "kamu tidak akan bisa mengembalikannya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus saja!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        var checkbox_value = [];
                        $(checkbox).each(function() {
                            checkbox_value.push($(this).val());
                        });

                        // console.log(checkbox);
                        $.ajax({
                            url: '<?= base_url('/pegawai/deletepegawai'); ?>',
                            type: "POST",
                            data: {
                                checkbox_value: checkbox_value
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.responce == "success") {
                                    // toastr["success"](data.pesan);
                                    Swal.fire(
                                        'Deleted!',
                                        'Data berhasil dihapus.',
                                        'success'
                                    )
                                    $('#tablePegawai').DataTable().destroy();
                                    fetchPegawai();
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