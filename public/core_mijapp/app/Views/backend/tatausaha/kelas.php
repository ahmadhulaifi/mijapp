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
                <button type="button" id="btntambahkelasbaru" class="btn btn-primary" data-toggle="modal" data-target="#kelasModal">
                    Tambah Kelas
                </button>

                <!-- Modal -->
                <div class="modal fade" id="kelasModal" tabindex="-1" aria-labelledby="kelasModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="kelasModalLabel">Tambah Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahkelasform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="kelas">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_divisi" class="col-sm-2 col-form-label">Divisi</label>
                                        <div class="col-sm-10">
                                            <select name="id_divisi" class="form-control">
                                                <option selected disabled>--- Divisi ---</option>
                                                <?php foreach ($divisi as $divisi) : ?>
                                                    <option value="<?= $divisi['id']; ?>"><?= $divisi['divisi']; ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                            <!-- <input type="text" class="form-control" name="controller"> -->
                                        </div>


                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnsavekelas" class="btn btn-primary">Simpan</button>
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
                    <table class="table table-striped" id="tabelKelas">
                        <thead class="bg-navy">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editkelasModal" tabindex="-1" aria-labelledby="editkelasModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editkelasModalLabel">Edit Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editkelasform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idkelas">
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kelas">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="controller" class="col-sm-2 col-form-label">Divisi</label>
                                <div class="col-sm-10">
                                    <select name="id_divisi" id="editdivisi" class="form-control">
                                        <option selected disabled>--- Divisi ---</option>

                                    </select>
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnupdatekelas" class="btn btn-primary">Update</button>
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


        function tabelkelas(dataks) {
            let i = 1;
            $('#tabelKelas').DataTable({
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
                    }

                ],

                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            let a = i++;
                            return a;
                        }
                    },

                    {
                        "data": "kelas"
                    },
                    {
                        "data": "divisi",

                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            let a = '';
                            a = `
                                    <a href="" class="badge badge-info editkelas" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deletekelas"><i class="fas fa-fw fa-trash-alt"></i></a>`;

                            return a;
                        }
                    },

                ],

            });
        }


        //fungsi fetch kelas
        function fetchKelas() {
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/fetchkelas',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);

                    tabelkelas(data.kelas);
                }
            });
        }

        fetchKelas();

        $(document).on('click', '#btntambahkelasbaru', function() {
            $('#tambahkelasform')[0].reset();
        })

        // tambah absen
        $('#tambahkelasform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/tatausaha/savekelas'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btnsavekelas').attr('disabled');
                    $("#btnsavekelas").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#kelasModal').modal('hide');
                        $('#tabelKelas').DataTable().destroy();

                        fetchKelas();
                        toastr["success"](data.pesan);
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnsavekelas').removeAttr('disabled');
                    $("#btnsavekelas").html(`Simpan`);

                },
            });
        });

        // modal edit
        $(document).on("click", ".editkelas", function() {
            event.preventDefault();
            $("#editdivisi").children().remove();
            let idkelas = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/tatausaha/editmodalkelas'); ?>',
                type: 'post',
                data: {
                    idkelas: idkelas
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        // console.log(data);
                        $('#editkelasModal').modal('show');
                        $("input[name='idkelas']").val(data.kelas.id);
                        $("input[name='kelas']").val(data.kelas.kelas);


                        for (let i = 0; i < data.divisi.length; i++) {
                            $("#editdivisi").append('<option value="' + data.divisi[i].id + '" ' + ((data.divisi[i].id == data.kelas.id_divisi) ? 'selected="selected"' : '') + '>' + data.divisi[i].divisi + '</option>');
                        }

                        // $("#editbulan").append('<option value="januari"' + ((data.absen.bulan == 'januari') ? 'selected="selected"' : '') + '>Januari</option>');


                    } else {

                        toastr["error"](data.pesan);
                    }

                }
            });
        });

        // edit absen

        $("#editkelasform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/editkelas',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btnupdatekelas').attr('disabled');
                    $("#btnupdatekelas").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editkelasModal').modal('hide');
                        $('#tabelKelas').DataTable().destroy();
                        fetchKelas();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }

                },
                complete: function() {
                    $('#btnupdatekelas').removeAttr('disabled');
                    $("#btnupdatekelas").html(`Update`);

                },

            });
        })



        // delete kelas
        $(document).on("click", ".deletekelas", function() {
            event.preventDefault();
            let idkelas = $(this).attr('value');

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
                        url: '<?= base_url('/tatausaha/deletekelas'); ?>/' + idkelas,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tabelKelas').DataTable().destroy();
                            fetchKelas();
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

    });
</script>

<?= $this->endSection(); ?>