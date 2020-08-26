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
                                <form method="post" action="<?= base_url(); ?>/menu/savesubmenu">
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
                    <table class="table">
                        <thead class="thead-dark">
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
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($submenu as $submenu) : ?>
                                <tr id="<?= $submenu['id']; ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $submenu['sub_menu']; ?></td>
                                    <td>
                                        <?php
                                        $db      = \Config\Database::connect();

                                        $namamenu = $db->table('user_menu')->where('id', $submenu['menu_id'])->get()->getRowArray();
                                        // dd($namamenu);
                                        ?>
                                        <?= $namamenu['menu']; ?>
                                    </td>
                                    <td><i class="<?= $submenu['icon']; ?>"></i></td>
                                    <td><?= $submenu['url']; ?></td>
                                    <td><?= $submenu['sort']; ?></td>
                                    <td>
                                        <?php if ($submenu['is_active'] == 1) {
                                            echo "active";
                                        } else {
                                            echo "not active";
                                        } ?>

                                    </td>
                                    <td>
                                        <a href="" class="badge badge-info" data-toggle="modal" data-target="#editMenuModal<?= $submenu['id']; ?>"><i class="far fa-fw fa-edit"></i></a>
                                        <a type="submit" href="" class="badge badge-danger deletesubmenu"><i class="fas fa-fw fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit menu -->
                                <div class="modal fade" id="editMenuModal<?= $submenu['id']; ?>" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editMenuModalLabel">Edit Sub Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('/menu/editsubmenu'); ?>/<?= $submenu['id']; ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="menu" class="col-sm-2 col-form-label">Submenu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="submenu" value="<?= $submenu['sub_menu']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                                                        <div class="col-sm-10">
                                                            <select class="custom-select" name="menu_id">
                                                                <option disabled value="">Pilih menu</option>
                                                                <?php foreach ($menu as $sm) : ?>
                                                                    <option <?= ($submenu['menu_id'] == $sm['id']) ? 'selected' : ''; ?> value="<?= $sm['id']; ?>"><?= $sm['menu']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="icon" value="<?= $submenu['icon']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="url" class="col-sm-2 col-form-label">Url</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="url" value="<?= $submenu['url']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="sort" class="col-sm-2 col-form-label">Sort</label>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" name="sort" value="<?= $submenu['sort']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_active" <?= ($submenu['is_active'] == 1) ? 'checked="checked"' : ''; ?>>
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

        // delete submenu
        $(".deletesubmenu").click(function() {
            event.preventDefault()
            let idsub = $(this).parents("tr").attr("id");

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
                        url: '<?= base_url('/menu/deletesubmenu'); ?>/' + idsub,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $("#" + idsub).remove();
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