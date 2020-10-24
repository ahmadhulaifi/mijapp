<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <!-- Button trigger modal -->

                <button type="button" id="btntambahabsenbaru" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                    Tambah
                </button>
                <button type="button" name="btndeleteabsenpegawai" id="btndeleteabsenpegawai" class="btn btn-danger">Hapus</button>
                <button type="button" id="btnimportabsenbaru" class="btn btn-info" data-toggle="modal" data-target="#importModal">
                    Import
                </button>

                <!-- modal import -->
                <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Data Absen Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Data -->
                                <form action="" method="POST" id="importabsenpegawai" enctype="multipart/form-data">
                                    <div class="form_group" style="margin-bottom: 5;">
                                        <label for="">Unggah File</label>
                                        <input type="file" id="fileabsenpegawai" name="fileabsenpegawai" class="form-control">
                                    </div>
                                    <br>
                                    <p style="font-size: 15px;"><a href="<?= base_url(); ?>/asset/template/template_import_absen_pegawai.xls">Download Template Import Absen Pegawai</a></p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnimportabsen" class="btn btn-primary">Import</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="searchbulan" name="searchbulan">
                    </div>
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="searchtahun" name="searchtahun">
                    </div>
                </div>
            </div>


        </div>


        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped" id="tableAbsenPegawai">
                        <thead class="bg-navy">
                            <tr>
                                <th scope="col"></th>
                                <th><input type="checkbox" id='checkall'></th>
                                <!-- <th scope="col">No</th> -->
                                <th scope="col">Action</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Bulan</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Sakit</th>
                                <th scope="col">Izin</th>
                                <th scope="col">Alpha</th>
                                <th scope="col">Cuti</th>
                                <th scope="col">Lainnya</th>
                                <th scope="col">Hadir</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Last User Update</th>

                            </tr>
                        </thead>


                    </table>
                </div>


            </div>
        </div>


        <!-- Modal Tambah Absen -->
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Absen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="tambahabsenform">

                            <div class="form-group row">
                                <label for="namalengkap" class="col-sm-2 control-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <select id="namalengkap" class="form-control selectnamalengkap" name="namalengkap" onchange="tampil()">
                                        <option selected disabled>Choose...</option>
                                        <?php foreach ($pegawai as $pegawai) : ?>
                                            <option value="<?= $pegawai['nip']; ?>"><?= $pegawai['nama_lengkap']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-sm-2">NIP</label>
                                <div class="col-sm-10">
                                    <p id="textnip">NIP Pegawai</p>
                                    <input type="hidden" class="form-control" id="nip" name="nip">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-4">
                                    <select id="bulan" class="form-control" name="bulan">
                                        <option selected disabled>Choose...</option>
                                        <option value="januari">Januari</option>
                                        <option value="februari">Februari</option>
                                        <option value="maret">Maret</option>
                                        <option value="april">April</option>
                                        <option value="mei">Mei</option>
                                        <option value="juni">Juni</option>
                                        <option value="juli">Juli</option>
                                        <option value="agustus">Agustus</option>
                                        <option value="september">September</option>
                                        <option value="oktober">Oktober</option>
                                        <option value="november">November</option>
                                        <option value="desember">Desember</option>
                                    </select>

                                </div>
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="tahun" name="tahun">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <center><label for="sakit">Sakit</label></center>
                                    <input type="text" class="form-control" id="sakit" name="sakit">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="izin">Izin</label></center>
                                    <input type="text" class="form-control" id="izin" name="izin">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="alpha">Alpha</label></center>
                                    <input type="text" class="form-control" id="alpha" name="alpha">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="cuti">Cuti</label></center>
                                    <input type="text" class="form-control" id="cuti" name="cuti">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="lain">Lainnya</label></center>
                                    <input type="text" class="form-control" id="lain" name="lain">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="hadir">Hadir</label></center>
                                    <input type="text" class="form-control" id="hadir" name="hadir">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnsaveabsen" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Absen -->
        <div class="modal fade" id="editabsenModal" tabindex="-1" aria-labelledby="editabsenModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editabsenModalLabel">Edit Absen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editabsenform">
                            <input type="hidden" name="idabsen">


                            <div class="form-group row">
                                <label for="nip" class="col-sm-2">NIP</label>
                                <div class="col-sm-10">
                                    <p id="edittextnip">NIP Pegawai</p>
                                    <input type="hidden" class="form-control" name="nip">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="editbulan" name="bulan">
                                        <option disabled>Choose...</option>
                                    </select>

                                </div>
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="tahun">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <center><label for="sakit">Sakit</label></center>
                                    <input type="text" class="form-control" name="sakit">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="izin">Izin</label></center>
                                    <input type="text" class="form-control" name="izin">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="alpha">Alpha</label></center>
                                    <input type="text" class="form-control" name="alpha">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="cuti">Cuti</label></center>
                                    <input type="text" class="form-control" name="cuti">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="lain">Lainnya</label></center>
                                    <input type="text" class="form-control" name="lain">
                                </div>
                                <div class="form-group col-md-2">
                                    <center><label for="hadir">Hadir</label></center>
                                    <input type="text" class="form-control" name="hadir">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnupdateabsen" class="btn btn-primary">Update</button>
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
    function tampil() {
        let nip = document.getElementById("namalengkap").value;
        // console.log(nip)
        document.getElementById("textnip").innerHTML = nip;
        document.getElementById("nip").value = nip;
    }
</script>

<script>
    $(document).ready(function() {

        $('.selectnamalengkap').select2({
            theme: "bootstrap"
        });


        function tabelabsen(dataks) {
            $('#tableAbsenPegawai').DataTable({
                "data": dataks,
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

                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            let a = '';
                            return a;
                        }
                    },
                    {
                        targets: 0,
                        data: null,
                        className: 'text-center',
                        searchable: false,
                        orderable: false,

                        "render": function(data, type, row, meta) {
                            var r =
                                '<input type="checkbox" name="deletecheckbox" id = "' + row.id + '"  value = "' + row.id + '" class="deletecheckbox"></input>';

                            return r;
                        },
                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            let a = '';
                            a = `
                            <center><a href="" class="badge badge-info editabsenpegawai" value="${row.id}"><i class="far fa-fw fa-edit"></i></a></center>`

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
                        "data": "bulan"
                    },
                    {
                        "data": "tahun"
                    },
                    {
                        "data": "sakit"
                    },
                    {
                        "data": "izin"
                    },
                    {
                        "data": "alpha"
                    },
                    {
                        "data": "cuti"
                    },
                    {
                        "data": "lain"
                    },
                    {
                        "data": "hadir"
                    },

                    {
                        "data": "created_at"
                    },
                    {
                        "data": "updated_at"
                    },
                    {
                        "data": "user_update"

                    }

                ],

            });
        }


        //fungsi fetch absen
        function fetchAbsen() {
            $.ajax({
                url: '<?= base_url(); ?>/pegawai/fetchabsenpegawai',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    tabelabsen(data.absen);
                }
            });
        }

        fetchAbsen();

        // #column3_search is a <input type="text"> element
        $('#searchbulan').on('keyup', function() {
            $('#tableAbsenPegawai').DataTable()
                .columns(5)
                .search(this.value)
                .draw();
        });

        $('#searchtahun').on('keyup', function() {
            $('#tableAbsenPegawai').DataTable()
                .columns(6)
                .search(this.value)
                .draw();
        });

        $(document).on('click', '#btntambahabsenbaru', function() {
            $('#tambahabsenform')[0].reset();
        })

        $(document).on('click', '#btnimportabsenbaru', function() {
            $('#importabsenpegawai')[0].reset();
        })

        // tambah absen
        $('#tambahabsenform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/pegawai/saveabsenpegawai'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btnsaveabsen').attr('disabled');
                    $("#btnsaveabsen").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#tambahModal').modal('hide');
                        $('#tableAbsenPegawai').DataTable().destroy();

                        fetchAbsen();
                        toastr["success"](data.pesan);
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnsaveabsen').removeAttr('disabled');
                    $("#btnsaveabsen").html(`Simpan`);

                },
            });
        });

        // modal edit
        $(document).on("click", ".editabsenpegawai", function() {
            event.preventDefault();
            $("#editbulan").children().remove();
            let idabsen = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/pegawai/editmodalabsen'); ?>',
                type: 'post',
                data: {
                    idabsen: idabsen
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        // console.log(data);
                        $('#editabsenModal').modal('show');
                        $("input[name='idabsen']").val(data.absen.id);


                        $("input[name='nip']").val(data.absen.nip);
                        $("#edittextnip").text(data.absen.nip);


                        $("#editbulan").append('<option value="januari"' + ((data.absen.bulan == 'januari') ? 'selected="selected"' : '') + '>Januari</option>');
                        $("#editbulan").append('<option value="februari"' + ((data.absen.bulan == 'februari') ? 'selected="selected"' : '') + '>Februari</option>');
                        $("#editbulan").append('<option value="maret"' + ((data.absen.bulan == 'maret') ? 'selected="selected"' : '') + '>Maret</option>');
                        $("#editbulan").append('<option value="april"' + ((data.absen.bulan == 'april') ? 'selected="selected"' : '') + '>April</option>');
                        $("#editbulan").append('<option value="mei"' + ((data.absen.bulan == 'mei') ? 'selected="selected"' : '') + '>Mei</option>');
                        $("#editbulan").append('<option value="juni"' + ((data.absen.bulan == 'juni') ? 'selected="selected"' : '') + '>Juni</option>');
                        $("#editbulan").append('<option value="juli"' + ((data.absen.bulan == 'juli') ? 'selected="selected"' : '') + '>Juli</option>');
                        $("#editbulan").append('<option value="agustus"' + ((data.absen.bulan == 'agustus') ? 'selected="selected"' : '') + '>Agustus</option>');
                        $("#editbulan").append('<option value="september"' + ((data.absen.bulan == 'september') ? 'selected="selected"' : '') + '>September</option>');
                        $("#editbulan").append('<option value="oktober"' + ((data.absen.bulan == 'oktober') ? 'selected="selected"' : '') + '>Oktober</option>');
                        $("#editbulan").append('<option value="november"' + ((data.absen.bulan == 'november') ? 'selected="selected"' : '') + '>November</option>');
                        $("#editbulan").append('<option value="desember"' + ((data.absen.bulan == 'desember') ? 'selected="selected"' : '') + '>Desember</option>');


                        $("input[name='tahun']").val(data.absen.tahun);
                        $("input[name='sakit']").val(data.absen.sakit);
                        $("input[name='izin']").val(data.absen.izin);
                        $("input[name='alpha']").val(data.absen.alpha);
                        $("input[name='cuti']").val(data.absen.cuti);
                        $("input[name='lain']").val(data.absen.lain);
                        $("input[name='hadir']").val(data.absen.hadir);
                    } else {

                        toastr["error"](data.pesan);
                    }

                }
            });
        });

        // edit absen

        $("#editabsenform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/pegawai/editabsenpegawai',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btnupdateabsen').attr('disabled');
                    $("#btnupdateabsen").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editabsenModal').modal('hide');
                        $('#tableAbsenPegawai').DataTable().destroy();
                        fetchAbsen();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }
                    $('#tambahabsenform')[0].reset();
                },
                complete: function() {
                    $('#btnupdateabsen').removeAttr('disabled');
                    $("#btnupdateabsen").html(`Update`);

                },

            });
        })

        // Check all 
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.deletecheckbox').prop('checked', true);
            } else {
                $('.deletecheckbox').prop('checked', false);
            }
        });

        $('.deletecheckbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });


        $('#btndeleteabsenpegawai').click(function() {
            let checkbox = $('.deletecheckbox:checked');

            if (checkbox.length > 0) {
                Swal.fire({
                    title: 'Apa kamu yakin ingin menghapus ' + checkbox.length + ' absen pegawai?',
                    text: "kamu tidak akan bisa mengembalikannya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus saja!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        let checkbox_value = [];
                        $(checkbox).each(function() {
                            checkbox_value.push($(this).val());
                        });

                        // console.log(checkbox);
                        $.ajax({
                            url: '<?= base_url('/pegawai/deleteabsenpegawai'); ?>',
                            type: "POST",
                            data: {
                                checkbox_value: checkbox_value
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.responce == "success") {

                                    Swal.fire(
                                        'Deleted!',
                                        'Data berhasil dihapus.',
                                        'success'
                                    )
                                    $('#tableAbsenPegawai').DataTable().destroy();
                                    fetchAbsen();
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


        // import pegawai
        $('#importabsenpegawai').submit(function() {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url('/pegawai/importabsenpegawai'); ?>',
                type: 'post',
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // setting a timeout
                    $('#btnimportabsen').attr('disabled');
                    $("#btnimportabsen").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {

                        $('#tableAbsenPegawai').DataTable().destroy();
                        fetchAbsen();
                        $('#importModal').modal('hide');
                        toastr["success"](data.pesan);
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnimportabsen').removeAttr('disabled');
                    $("#btnimportabsen").html(`Update`);

                },
            });

        });



    });
</script>

<?= $this->endSection(); ?>