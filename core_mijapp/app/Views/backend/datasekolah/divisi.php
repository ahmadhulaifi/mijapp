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
                <button type="button" class="btn btn-success" id="btntambahdivisibaru" data-toggle="modal" data-target="#divisiModal">
                    Tambah Divisi
                </button>

                <!-- Modal -->
                <div class="modal fade" id="divisiModal" tabindex="-1" aria-labelledby="divisiModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="divisiModalLabel">Tambah Divisi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahdivisiform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="divisi" class="col-sm-2 col-form-label">Divisi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="divisi">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="sort" class="col-sm-2 col-form-label">Sort</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="sort">
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnsavedivisi" class="btn btn-primary">Simpan</button>
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
                    <table class="table table-striped" id="tableDivisi">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editdivisiModal" tabindex="-1" aria-labelledby="editdivisiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editdivisiModalLabel">Edit Divisi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editdivisiform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="iddivisi">
                            <div class="form-group row">
                                <label for="divisi" class="col-sm-2 col-form-label">Divisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="divisi">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sort" class="col-sm-2 col-form-label">Sort</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="sort">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btneditdivisi" class="btn btn-primary">Update</button>
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

        $("#btntambahdivisibaru").click(function() {
            $('#tambahdivisiform')[0].reset();
        });

        //fetch divisi
        function fetchDivisi() {
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/fetchdivisi',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    $('#tableDivisi').DataTable({
                        "data": data.divisi,
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
                                "data": "divisi"
                            },
                            {
                                "data": "sort"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <a href="" class="badge badge-info editdivisi" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deletedivisi"><i class="fas fa-fw fa-trash-alt"></i></a>`;

                                    return a;
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetchDivisi();

        // save divisi
        $('#tambahdivisiform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/datasekolah/savedivisi'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                // data: $(this).serialize(),
                beforeSend: function() {
                    // setting a timeout
                    $('#btnsavedivisi').attr('disabled');
                    $("#btnsavedivisi").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#divisiModal').modal('hide');
                        $('#tableDivisi').DataTable().destroy();

                        fetchDivisi();
                        toastr["success"](data.pesan);

                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnsavedivisi').removeAttr('disabled');
                    $("#btnsavedivisi").html(`Simpan`);

                },
            });
        });

        // delete divisi
        $(document).on("click", ".deletedivisi", function() {
            event.preventDefault();
            let iddivisi = $(this).attr('value');

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
                        url: '<?= base_url('/datasekolah/deletedivisi'); ?>/' + iddivisi,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tableDivisi').DataTable().destroy();
                            fetchDivisi();
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
        $(document).on("click", ".editdivisi", function() {
            event.preventDefault();
            let iddivisi = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/datasekolah/editdivisimodal'); ?>',
                type: 'post',
                data: {
                    iddivisi: iddivisi
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        $('#editdivisiModal').modal('show');
                        $("input[name='iddivisi']").val(data.divisi.id);
                        $("input[name='divisi']").val(data.divisi.divisi);
                        $("input[name='sort']").val(data.divisi.sort);
                    } else {

                        toastr["error"](data.pesan);
                    }
                }
            });
        });

        // edit Divisi

        $("#editdivisiform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/editdivisi',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btneditdivisi').attr('disabled');
                    $("#btneditdivisi").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editdivisiModal').modal('hide');
                        $('#tableDivisi').DataTable().destroy();
                        fetchDivisi();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btneditdivisi').removeAttr('disabled');
                    $("#btneditdivisi").html(`Update`);

                },
            });


        });

    });
</script>

<?= $this->endSection(); ?>