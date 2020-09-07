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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submenuModal">
                    Tambah Sub Menu
                </button>

                <!-- Modal -->
                <div class="modal fade" id="submenuModal" tabindex="-1" aria-labelledby="submenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="submenuModalLabel">Tambah Sub Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahsubform">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="menu" class="col-sm-2 col-form-label">Submenu</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="submenu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                        <div class="col-sm-10">
                                            <select class="custom-select" name="menu_id">
                                                <option selected disabled value="">Pilih menu</option>
                                                <?php foreach ($menu as $sm) : ?>
                                                    <option value="<?= $sm['id']; ?>"><?= $sm['menu']; ?></option>
                                                <?php endforeach; ?>
                                            </select>

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

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" checked='checked'>
                                        <label class="form-check-label" for="is_active">
                                            Aktif?
                                        </label>
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
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped" id="tableSubMenu">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Submenu</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Url</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

        <!-- Modal Edit Sub Menu-->
        <div class="modal fade" id="editsubmenuModal" tabindex="-1" aria-labelledby="editsubmenuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editsubmenuModalLabel">Edit Sub Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editsubform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idsubmenu">
                            <div class="form-group row">
                                <label for="menu" class="col-sm-2 col-form-label">Submenu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="submenu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="menu_id" id="editmenuid">
                                        <option disabled value="">Pilih menu</option>
                                        <?php foreach ($menu as $sm) : ?>
                                            <option value="<?= $sm['id']; ?>"><?= $sm['menu']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

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

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active">
                                <label class="form-check-label" for="is_active">
                                    Aktif?
                                </label>
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

        function fetchsubmenu() {
            $.ajax({
                url: '<?= base_url('/menu/fetchsubmenu'); ?>',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    $('#tableSubMenu').DataTable({
                        "data": data.submenu,
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
                                "data": "sub_menu"
                            },
                            {
                                "data": "menu"
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
                                    if (`${row.is_active}` == '1') {
                                        a = `active`;
                                    } else {
                                        a = `not active`;
                                    }

                                    return a;
                                }

                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    a = `
                                    <a href="" class="badge badge-info editsubmenu" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deletesubmenu"><i class="fas fa-fw fa-trash-alt"></i></a>`;

                                    return a;
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetchsubmenu();

        // tambah submenu
        $('#tambahsubform').submit(function() {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url('menu/savesubmenu'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.responce == 'success') {
                        $('#submenuModal').modal('hide');
                        $('#tableSubMenu').DataTable().destroy();
                        $('#tambahsubform')[0].reset();
                        fetchsubmenu();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }
                }

            });

        })

        // edit modal sub
        $(document).on("click", ".editsubmenu", function() {
            event.preventDefault();
            let idsubmenu = $(this).attr('value');

            $.ajax({
                url: '<?= base_url('menu/editsub'); ?>',
                type: 'post',
                data: {
                    idsubmenu: idsubmenu
                },
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        // console.log(data);
                        $('#editsubmenuModal').modal('show');
                        $("input[name='idsubmenu']").val(data.submenu.id);
                        $("input[name='submenu']").val(data.submenu.sub_menu);

                        var i;
                        for (i = 0; i < $("#editmenuid").children().length; i++) {
                            if ($("#editmenuid").children(':eq(' + i + ')').val() == data.submenu.menu_id) {
                                $("#editmenuid").children(':eq(' + i + ')').attr("selected", "");

                            } else {
                                $("#editmenuid").children(':eq(' + i + ')').removeAttr("selected");
                            }
                        }

                        $("input[name='icon']").val(data.submenu.icon);
                        $("input[name='url']").val(data.submenu.url);
                        $("input[name='sort']").val(data.submenu.sort);

                        if (data.submenu.is_active == 1) {
                            $("input[name='is_active']").attr("checked", "checked");
                        } else {
                            $("input[name='is_active']").removeAttr("checked");
                        }


                    } else {
                        toastr["error"](data.pesan);
                    }
                },

            });
        });


        $('#editsubform').submit(function() {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url('menu/editsubmenu'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.responce == 'success') {
                        $('#editsubmenuModal').modal('hide');
                        $('#tableSubMenu').DataTable().destroy();
                        fetchsubmenu();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }
                }
            });
        });


        // delete submenu
        $(document).on("click", ".deletesubmenu", function() {
            event.preventDefault();
            let idsubmenu = $(this).attr('value')

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
                        url: '<?= base_url('/menu/deletesubmenu'); ?>/' + idsubmenu,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tableSubMenu').DataTable().destroy();
                            fetchsubmenu();
                            Swal.fire(
                                'Deleted!',
                                'File sudah terdelete.',
                                'success'
                            )

                        }
                    });

                }
            })
        })



    });
</script>

<?= $this->endSection(); ?>