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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#roleModal">
                    Tambah Role
                </button>

                <!-- Modal Tambah -->
                <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="roleModalLabel">Tambah Role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="addrole">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="menu" class="col-sm-2 col-form-label">Kode Role</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="role_kode">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="icon" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="role">
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
                    <table class="table table-striped" id="tableRole">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Role</th>
                                <th scope="col">Role</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>


            </div>
        </div>

        <!-- modal edit -->
        <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="editroleform">
                            <?= csrf_field(); ?>
                            <input type="hidden" class="form-control" name="idrole">
                            <div class="form-group row">
                                <label for="menu" class="col-sm-2 col-form-label">Kode Role</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="editrole_kode">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="icon" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="editrole">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sort" class="col-sm-2 col-form-label">Sort</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="editsort">
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

        //fetch role
        function fetchRole() {
            $.ajax({
                url: '<?= base_url(); ?>/role/fetchrole',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    let i = "1";
                    $('#tableRole').DataTable({
                        "data": data.role,
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
                                "data": "role_kode"
                            },
                            {
                                "data": "role"
                            },
                            {
                                "data": "sort"
                            },
                            {
                                "data": null,
                                "render": function(data, type, row, meta) {
                                    let a = '';
                                    if (`${row.role_kode}` == 'ADMIN') {
                                        a = `
                                    <a href="<?= base_url('role/roleakses'); ?>/${row.role_kode}" class="badge badge-warning"><i class="fas fa-fw fa-sign-in-alt"></i></a>
                                    `
                                    } else {
                                        a = `
                                    <a href="<?= base_url('role/roleakses'); ?>/${row.role_kode}" class="badge badge-warning"><i class="fas fa-fw fa-sign-in-alt"></i></a>
   
                                    <a href="" class="badge badge-info editrole" value="${row.id}"><i class="far fa-fw fa-edit"></i></a>
                                    <a href="" value="${row.id}" class="badge badge-danger deleterole"><i class="fas fa-fw fa-trash-alt"></i></a>`
                                    };

                                    return a;
                                }
                            }
                        ]
                    });
                }
            });
        }

        fetchRole();

        // add role
        $("#addrole").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/role/saverole',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.responce == "success") {
                        $('#roleModal').modal('hide')
                        $('#tableRole').DataTable().destroy();
                        fetchRole();
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                    }
                }
            });


        });


        // delete role

        $(document).on("click", ".deleterole", function(e) {
            e.preventDefault();
            let idrole = $(this).attr("value");

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
                        url: '<?= base_url(); ?>/role/deleterole/' + idrole,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tableRole').DataTable().destroy();
                            fetchRole();
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

        // edit role modal
        $(document).on("click", ".editrole", function(e) {
            e.preventDefault();

            let edit_id = $(this).attr("value");

            $.ajax({
                url: '<?= base_url('/role/edit'); ?>',
                type: 'post',
                dataType: 'json',
                data: {
                    edit_id: edit_id
                },
                success: function(data) {
                    // console.log(data)
                    $('#editRoleModal').modal('show');
                    $("input[name='idrole']").val(data.posts.id);
                    $("input[name='editrole_kode']").val(data.posts.role_kode);
                    $("input[name='editrole']").val(data.posts.role);
                    $("input[name='editsort']").val(data.posts.sort);
                }
            });
        });

        // edit role
        $("#editroleform").submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: '<?= base_url(); ?>/role/editrole',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.responce == "success") {
                        $('#editRoleModal').modal('hide');
                        $('#tableRole').DataTable().destroy();
                        fetchRole();
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