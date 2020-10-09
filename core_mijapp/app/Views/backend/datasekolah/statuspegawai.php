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
                <button type="button" class="btn btn-success" id="btntambahstatuspegawai" data-toggle="modal" data-target="#statuspegawaiModal">
                    Tambah Status Pegawai
                </button>

                <!-- Modal -->
                <div class="modal fade" id="statuspegawaiModal" tabindex="-1" aria-labelledby="statuspegawaiModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="statuspegawaiModalLabel">Tambah Status Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahstatuspegawaiform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="status_pegawai_kode" class="col-sm-2 col-form-label">Kode Status</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="status_pegawai_kode">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status_pegawai" class="col-sm-2 col-form-label">Status Pegawai</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="status_pegawai">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnsavestatuspegawai" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped" id="tableStatusPegawai">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Status Pegawai</th>
                                <th scope="col">Status Pegawai</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editstatuspegawaiModal" tabindex="-1" aria-labelledby="editstatuspegawaiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editstatuspegawaiModalLabel">Edit Status Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editstatuspegawaiform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idstatuspegawai">
                            <div class="form-group row">
                                <label for="status_pegawai_kode" class="col-sm-2 col-form-label">Kode Status Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="status_pegawai_kode">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_pegawai" class="col-sm-2 col-form-label">Status Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="status_pegawai">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnupdatestatuspegawai" class="btn btn-primary">Update</button>
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

        $("#btntambahstatuspegawai").click(function() {
            $('#tambahstatuspegawaiform')[0].reset();
        });

        //fetch status pegawai
        function fetchStatus() {
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/fetchstatuspegawai',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    $('#tableStatusPegawai').DataTable({
                        "data": data.status_pegawai,
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
                            }
                        ],

                        "columns": [{
                                "data": null,
                                "render": function() {
                                    return a = i++;
                                }
                            },
                            {
                                "data": "status_pegawai_kode"
                            },
                            {
                                "data": "status_pegawai"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <a href="" class="badge badge-info editstatuspegawai" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deletestatuspegawai"><i class="fas fa-fw fa-trash-alt"></i></a>`;

                                    return a;
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetchStatus();

        // save Status pegawai
        $('#tambahstatuspegawaiform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/datasekolah/savestatuspegawai'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                // data: $(this).serialize(),
                beforeSend: function() {
                    // setting a timeout
                    $('#btnsavestatuspegawai').attr('disabled');
                    $("#btnsavestatuspegawai").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#statuspegawaiModal').modal('hide');
                        $('#tableStatusPegawai').DataTable().destroy();

                        fetchStatus();
                        toastr["success"](data.pesan);

                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnsavestatuspegawai').removeAttr('disabled');
                    $("#btnsavestatuspegawai").html(`Simpan`);

                },
            });
        });

        // delete Status pegawai
        $(document).on("click", ".deletestatuspegawai", function() {
            event.preventDefault();
            let idstatuspegawai = $(this).attr('value');

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
                        url: '<?= base_url('/datasekolah/deletestatuspegawai'); ?>/' + idstatuspegawai,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tableStatusPegawai').DataTable().destroy();
                            fetchStatus();
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
        $(document).on("click", ".editstatuspegawai", function() {
            event.preventDefault();
            let idstatuspegawai = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/datasekolah/editstatuspegawaimodal'); ?>',
                type: 'post',
                data: {
                    idstatuspegawai: idstatuspegawai
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        $('#editstatuspegawaiModal').modal('show');
                        $("input[name='idstatuspegawai']").val(data.status_pegawai.id);
                        $("input[name='status_pegawai_kode']").val(data.status_pegawai.status_pegawai_kode);
                        $("input[name='status_pegawai']").val(data.status_pegawai.status_pegawai);
                    } else {

                        toastr["error"](data.pesan);
                    }
                }
            });
        });

        // edit Jabatan

        $("#editstatuspegawaiform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/editstatuspegawai',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btnupdatestatuspegawai').attr('disabled');
                    $("#btnupdatestatuspegawai").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editstatuspegawaiModal').modal('hide');
                        $('#tableStatusPegawai').DataTable().destroy();
                        fetchStatus();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnupdatestatuspegawai').removeAttr('disabled');
                    $("#btnupdatestatuspegawai").html(`Update`);

                },
            });
        });



    });
</script>

<?= $this->endSection(); ?>