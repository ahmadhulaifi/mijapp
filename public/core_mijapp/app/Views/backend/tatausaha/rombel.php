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
                <button type="button" id="btntambahrombelbaru" class="btn btn-primary" data-toggle="modal" data-target="#rombelModal">
                    Tambah Rombel
                </button>

                <!-- Modal -->
                <div class="modal fade" id="rombelModal" tabindex="-1" aria-labelledby="rombelModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rombelModalLabel">Tambah Rombel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahrombelform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="rombel">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                        <div class="col-sm-10">
                                            <select name="id_kelas" id="cektambahkelas" class="form-control">
                                                <option selected disabled>--- Kelas ---</option>
                                                <?php foreach ($kelas as $kelas) : ?>
                                                    <option value="<?= $kelas['id']; ?>"><?= $kelas['kelas']; ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                            <!-- <input type="text" class="form-control" name="controller"> -->
                                        </div>


                                    </div>
                                    <div class="form-group row">
                                        <label for="divisi" class="col-sm-2 col-form-label">divisi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="ceknamadivisi" value="nama divisi" disabled>
                                        </div>


                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnsaverombel" class="btn btn-primary">Simpan</button>
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
                    <table class="table table-striped" id="tabelRombel">
                        <thead class="bg-navy">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Rombel</th>
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
        <div class="modal fade" id="editrombelModal" tabindex="-1" aria-labelledby="editrombelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editrombelModalLabel">Edit Rombel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editrombelform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idrombel">
                            <div class="form-group row">
                                <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="rombel">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="controller" class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select name="id_kelas" id="editkelas" class="form-control">
                                        <option selected disabled>--- Kelas ---</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="divisi" class="col-sm-2 col-form-label">divisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cekeditnamadivisi" value="nama divisi" disabled>
                                </div>


                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnupdaterombel" class="btn btn-primary">Update</button>
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

        $('#cektambahkelas').on('change', function() {
            let idkelas = this.value;
            // console.log(idkelas)
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/cekdivisirombel',
                type: 'post',
                data: {
                    idkelas: idkelas
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data.divisi.divisi);
                    $('#ceknamadivisi').val(data.divisi.divisi)
                }
            });
        })

        $('#editkelas').on('change', function() {
            let idkelas = this.value;
            // console.log(idkelas)
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/cekdivisirombel',
                type: 'post',
                data: {
                    idkelas: idkelas
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data.divisi.divisi);
                    $('#cekeditnamadivisi').val(data.divisi.divisi)
                }
            });
        })



        function tabelrombel(dataks) {
            let i = 1;
            $('#tabelRombel').DataTable({
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
                        "data": "rombel"
                    },
                    {
                        "data": "kelas",

                    },
                    {
                        "data": "divisi",

                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            let a = '';
                            a = `
                                    <a href="" class="badge badge-info editrombel" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deleterombel"><i class="fas fa-fw fa-trash-alt"></i></a>`;

                            return a;
                        }
                    },

                ],

            });
        }


        //fungsi fetch kelas
        function fetchRombel() {
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/fetchrombel',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);

                    tabelrombel(data.rombel);
                }
            });
        }

        fetchRombel();


        $(document).on('click', '#btntambahrombelbaru', function() {
            $('#tambahrombelform')[0].reset();
        })

        // tambah rombel
        $('#tambahrombelform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/tatausaha/saverombel'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btnsaverombel').attr('disabled');
                    $("#btnsaverombel").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#rombelModal').modal('hide');
                        $('#tabelRombel').DataTable().destroy();

                        fetchRombel();
                        toastr["success"](data.pesan);
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnsaverombel').removeAttr('disabled');
                    $("#btnsaverombel").html(`Simpan`);

                },
            });
        });

        // modal edit
        $(document).on("click", ".editrombel", function() {
            event.preventDefault();
            $("#editkelas").children().remove();
            let idrombel = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/tatausaha/editmodalrombel'); ?>',
                type: 'post',
                data: {
                    idrombel: idrombel
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        // console.log(data);
                        $('#editrombelModal').modal('show');
                        $("input[name='idrombel']").val(data.rombel.id);
                        $("input[name='rombel']").val(data.rombel.rombel);
                        $("#cekeditnamadivisi").val(data.rombel.divisi);



                        for (let i = 0; i < data.kelas.length; i++) {
                            $("#editkelas").append('<option value="' + data.kelas[i].id + '" ' + ((data.kelas[i].id == data.rombel.id_kelas) ? 'selected="selected"' : '') + '>' + data.kelas[i].kelas + '</option>');
                        }

                        // $("#editbulan").append('<option value="januari"' + ((data.absen.bulan == 'januari') ? 'selected="selected"' : '') + '>Januari</option>');


                    } else {

                        toastr["error"](data.pesan);
                    }

                }
            });
        });

        // edit rombel
        $("#editrombelform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/editrombel',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // setting a timeout
                    $('#btnupdaterombel').attr('disabled');
                    $("#btnupdaterombel").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editrombelModal').modal('hide');
                        $('#tabelRombel').DataTable().destroy();
                        fetchRombel();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }

                },
                complete: function() {
                    $('#btnupdaterombel').removeAttr('disabled');
                    $("#btnupdaterombel").html(`Update`);

                },

            });
        })


        // delete rombel
        $(document).on("click", ".deleterombel", function() {
            event.preventDefault();
            let idrombel = $(this).attr('value');

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
                        url: '<?= base_url('/tatausaha/deleterombel'); ?>/' + idrombel,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tabelRombel').DataTable().destroy();
                            fetchRombel();
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