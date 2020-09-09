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
                <button type="button" class="btn btn-success" id="btntambahjabatan" data-toggle="modal" data-target="#jabatanModal">
                    Tambah Divisi
                </button>

                <!-- Modal -->
                <div class="modal fade" id="jabatanModal" tabindex="-1" aria-labelledby="jabatanModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="jabatanModalLabel">Tambah Jabatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahjabatanform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="jabatan_kode" class="col-sm-2 col-form-label">Kode Jabatan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jabatan_kode">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="jabatan">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
                    <table class="table table-striped" id="tableJabatan">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Jabatan</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editjabatanModal" tabindex="-1" aria-labelledby="editjabatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editjabatanModalLabel">Edit Jabatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editjabatanform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idjabatan">
                            <div class="form-group row">
                                <label for="jabatan_kode" class="col-sm-2 col-form-label">Kode Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jabatan_kode">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jabatan">
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

        $("#btntambahjabatan").click(function() {
            $('#tambahjabatanform')[0].reset();
        });

        //fetch jabatan
        function fetchJabatan() {
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/fetchjabatan',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    $('#tableJabatan').DataTable({
                        "data": data.jabatan,
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
                                "data": "jabatan_kode"
                            },
                            {
                                "data": "jabatan"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <a href="" class="badge badge-info editjabatan" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deletejabatan"><i class="fas fa-fw fa-trash-alt"></i></a>`;

                                    return a;
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetchJabatan();

        // save jabatan
        $('#tambahjabatanform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/datasekolah/savejabatan'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                // data: $(this).serialize(),
                success: function(data) {
                    if (data.responce == "success") {
                        $('#jabatanModal').modal('hide');
                        $('#tableJabatan').DataTable().destroy();
                        $('#tambahjabatanform')[0].reset();
                        fetchJabatan();
                        toastr["success"](data.pesan);

                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                }
            });
        });

        // delete jabatan
        $(document).on("click", ".deletejabatan", function() {
            event.preventDefault();
            let idjabatan = $(this).attr('value');

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
                        url: '<?= base_url('/datasekolah/deletejabatan'); ?>/' + idjabatan,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tableJabatan').DataTable().destroy();
                            fetchJabatan();
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
        $(document).on("click", ".editjabatan", function() {
            event.preventDefault();
            let idjabatan = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/datasekolah/editjabatanmodal'); ?>',
                type: 'post',
                data: {
                    idjabatan: idjabatan
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        $('#editjabatanModal').modal('show');
                        $("input[name='idjabatan']").val(data.jabatan.id);
                        $("input[name='jabatan_kode']").val(data.jabatan.jabatan_kode);
                        $("input[name='jabatan']").val(data.jabatan.jabatan);
                    } else {

                        toastr["error"](data.pesan);
                    }
                }
            });
        });

        // edit Jabatan

        $("#editjabatanform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/editjabatan',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editjabatanModal').modal('hide');
                        $('#tableJabatan').DataTable().destroy();
                        fetchJabatan();
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