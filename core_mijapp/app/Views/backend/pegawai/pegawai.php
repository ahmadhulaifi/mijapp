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
                <a href="<?= base_url(); ?>/pegawai/formtambah" type="button" class="btn btn-success">
                    Tambah Pegawai
                </a>
                <a href="<?= base_url(); ?>/profil/editprofil/<?= $user['id']; ?>" type="button" class="btn btn-danger">
                    Hapus Pegawai
                </a>

            </div>

        </div>


        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped" id="tablePegawai">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
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
                            </tr>
                        </thead>

                    </table>
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

                        "columns": [{
                                "data": null,
                                "render": function() {
                                    return a = i++;
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <a href="" class="badge badge-info editpegawai" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deletepegawai"><i class="fas fa-fw fa-trash-alt"></i></a>`;

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
                                "data": "tgl_lahir"
                            },
                            {
                                "data": "tgl_mulai_bekerja"
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
                            }

                        ]
                    });
                }
            });
        }

        fetchPegawai();



        // delete menu
        $(document).on("click", ".deletemenu", function() {
            event.preventDefault();
            let idmenu = $(this).attr('value');

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
                            $('#tableMenu').DataTable().destroy();
                            fetchMenu();
                            Swal.fire(
                                'Deleted!',
                                'File sudah terdelete.',
                                'success'
                            )
                        }
                    });

                }
            })
        });

        // modal edit
        $(document).on("click", ".editmenu", function() {
            event.preventDefault();
            let idmenu = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/menu/edit'); ?>',
                type: 'post',
                data: {
                    idmenu: idmenu
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        $('#editmenuModal').modal('show');
                        $("input[name='idmenu']").val(data.menu.id);
                        $("input[name='menu']").val(data.menu.menu);
                        $("input[name='icon']").val(data.menu.icon);
                        $("input[name='url']").val(data.menu.url);
                        $("input[name='sort']").val(data.menu.sort);
                    } else {

                        toastr["error"](data.pesan);
                    }
                }
            });
        });

        // edit menu

        $("#editmenuform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/menu/editmenu',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editmenuModal').modal('hide');
                        $('#tableMenu').DataTable().destroy();
                        fetchMenu();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }
                }
            });


        });

    });
</script>

<?= $this->endSection(); ?>