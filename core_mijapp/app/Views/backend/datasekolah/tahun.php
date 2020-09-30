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
                <!-- <button type="button" class="btn btn-success" id="btntambahtahun" data-toggle="modal" data-target="#tahunModal">
                    Tambah Tahun Ajaran
                </button> -->

                <!-- Modal -->
                <div class="modal fade" id="tahunModal" tabindex="-1" aria-labelledby="tahunModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tahunModalLabel">Tambah Tahun Ajaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahtahunform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="tahun" class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="tahun">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tahun" class="col-sm-5 col-form-label"></label>
                                        <div class="col-sm-7">
                                            <input class="form-check-input" type="checkbox" name="is_active" checked='checked'>
                                            <label class="form-check-label" for="is_active">
                                                Aktif?
                                            </label>
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
                    <table class="table table-striped" id="tableTahun">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">Aktif</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="edittahunModal" tabindex="-1" aria-labelledby="edittahunModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edittahunModalLabel">Edit Tahun Ajaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="edittahunform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idtahun">
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="tahun">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tahun" class="col-sm-5 col-form-label"></label>
                                <div class="col-sm-7">
                                    <input class="form-check-input" type="checkbox" name="aktif">
                                    <label class="form-check-label" for="aktif">
                                        Aktif?
                                    </label>
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

        $("#btntambahdivisi").click(function() {
            $('#tambahdivisiform')[0].reset();
        });

        //fetch divisi
        function fetchTahun() {
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/fetchtahun',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    $('#tableTahun').DataTable({
                        "data": data.tahun,
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
                                "data": "tahun"
                            },
                            {
                                "data": "aktif",
                                "render": function(data, type, row, meta) {

                                    let a = '';

                                    if (data == 1) {
                                        a = `
                                    <btn class="badge badge-success">Aktif</btn>
                                   `;
                                    } else {
                                        a = `
                                    <btn class="badge badge-danger">Non Aktif</btn>
                                   `;
                                    }

                                    return a;
                                }
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <a href="" class="badge badge-info edittahun" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                   `;

                                    return a;
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetchTahun();

        // save divisi
        $('#tambahdivisiform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/datasekolah/savedivisi'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                // data: $(this).serialize(),
                success: function(data) {
                    if (data.responce == "success") {
                        $('#divisiModal').modal('hide');
                        $('#tableDivisi').DataTable().destroy();
                        $('#tambahdivisiform')[0].reset();
                        fetchDivisi();
                        toastr["success"](data.pesan);

                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                }
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
        $(document).on("click", ".edittahun", function() {
            event.preventDefault();
            let idtahun = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/datasekolah/editmodaltahun'); ?>',
                type: 'post',
                data: {
                    idtahun: idtahun
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        $('#edittahunModal').modal('show');
                        $("input[name='idtahun']").val(data.tahun.id);
                        $("input[name='tahun']").val(data.tahun.tahun);

                        if (data.tahun.aktif == 1) {
                            $("input[name='aktif']").attr("checked", "checked");
                        }
                    } else {

                        toastr["error"](data.pesan);
                    }
                }
            });
        });

        // edit Divisi

        $("#edittahunform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/datasekolah/edittahun',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#edittahunModal').modal('hide');
                        $('#tableTahun').DataTable().destroy();
                        fetchTahun();
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