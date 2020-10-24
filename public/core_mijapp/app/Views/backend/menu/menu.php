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
                <button type="button" id="btntambahmenubaru" class="btn btn-primary" data-toggle="modal" data-target="#menuModal">
                    Tambah Menu
                </button>

                <!-- Modal -->
                <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="menuModalLabel">Tambah Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahmenuform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="menu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="controller" class="col-sm-2 col-form-label">Controller</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="controller">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="icon">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="url" class="col-sm-2 col-form-label">Url</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="url">
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
                                <button type="submit" id="btnsavemenu" class="btn btn-primary">Simpan</button>
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
                    <table class="table table-striped" id="tableMenu">
                        <thead class="bg-navy">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Controller</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Url</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editmenuModal" tabindex="-1" aria-labelledby="editmenuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editmenuModalLabel">Edit Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editmenuform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idmenu">
                            <div class="form-group row">
                                <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="menu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="controller" class="col-sm-2 col-form-label">Controller</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="controller">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="icon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="url" class="col-sm-2 col-form-label">Url</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url">
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
                        <button type="submit" id="btnupdatemenu" class="btn btn-primary">Update</button>
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

        //fetch menu
        function fetchMenu() {
            $.ajax({
                url: '<?= base_url(); ?>/menu/fetchmenu',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    $('#tableMenu').DataTable({
                        "data": data.menu,
                        "responsive": true,
                        "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        "buttons": [
                            'copy', 'excel', 'pdf'
                        ],

                        "columns": [{
                                "data": null,
                                "render": function() {
                                    return a = i++;
                                }
                            },
                            {
                                "data": "menu"
                            },
                            {
                                "data": "controller"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <i class="${row.icon}"></i>`;

                                    return a;
                                }

                            },
                            {
                                "data": "url"
                            },
                            {
                                "data": "sort"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <a href="" class="badge badge-info editmenu" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deletemenu"><i class="fas fa-fw fa-trash-alt"></i></a>`;

                                    return a;
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetchMenu();

        $(document).on('click', '#btntambahmenubaru', function() {
            $('#tambahmenuform')[0].reset();
        })

        // save menu
        $('#tambahmenuform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('/menu/savemenu'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                // data: $(this).serialize(),
                beforeSend: function() {
                    // setting a timeout
                    $('#btnsavemenu').attr('disabled');
                    $("#btnsavemenu").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        $('#menuModal').modal('hide');
                        $('#tableMenu').DataTable().destroy();

                        fetchMenu();
                        toastr["success"](data.pesan);

                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnsavemenu').removeAttr('disabled');
                    $("#btnsavemenu").html(`Simpan`);
                },
            });
        });

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
                        $("input[name='controller']").val(data.menu.controller);
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
                beforeSend: function() {
                    // setting a timeout
                    $('#btnupdatemenu').attr('disabled');
                    $("#btnupdatemenu").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
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
                },
                complete: function() {
                    $('#btnupdatemenu').removeAttr('disabled');
                    $("#btnupdatemenu").html(`Update`);

                },
            });


        });

    });
</script>

<?= $this->endSection(); ?>