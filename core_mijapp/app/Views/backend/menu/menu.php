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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#menuModal">
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
                                <form method="post" action="<?= base_url(); ?>/menu/savemenu">
                                    <?= csrf_field(); ?>
                                    <div class="form-group row">
                                        <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="menu">
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
                    <table class="table table-striped" id="tableMenu">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Url</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($menu as $menu) : ?>
                                <tr id="<?= $menu['id']; ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $menu['menu']; ?></td>
                                    <td><i class="<?= $menu['icon']; ?>"></i></td>
                                    <td><?= $menu['url']; ?></td>
                                    <td><?= $menu['sort']; ?></td>
                                    <td>
                                        <a href="" class="badge badge-info" data-toggle="modal" data-target="#editMenuModal<?= $menu['id']; ?>"><i class="far fa-fw fa-edit"></i></a>
                                        <a type="submit" href="" class="badge badge-danger deletemenu"><i class="fas fa-fw fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit menu -->
                                <div class="modal fade" id="editMenuModal<?= $menu['id']; ?>" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="newMenuModalLabel">Edit Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('/menu/editmenu'); ?>/<?= $menu['id']; ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="menu" placeholder="Nama Menu" value="<?= $menu['menu']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="icon" placeholder="Menu Icon" value="<?= $menu['icon']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="url" class="col-sm-2 col-form-label">Url</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="url" placeholder="Url Menu" value="<?= $menu['url']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="menu" class="col-sm-2 col-form-label">Sort</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="sort" placeholder="Sort Menu" value="<?= $menu['sort']; ?>">
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

                            <?php endforeach; ?>

                        </tbody>
                    </table>
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


        $('#tableMenu').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });

        // delete menu
        $(".deletemenu").click(function() {
            event.preventDefault()
            let idmenu = $(this).parents("tr").attr("id");

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
                            $("#" + idmenu).remove();
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