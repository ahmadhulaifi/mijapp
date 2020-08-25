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

                <!-- Modal -->
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
                                <form method="post" action="<?= base_url(); ?>/role/saverole">
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
                                <th scope="col">Kode Role</th>
                                <th scope="col">Role</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($role as $role) : ?>
                                <tr id="<?= $role['id']; ?>">
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $role['role_kode']; ?></td>
                                    <td><?= $role['role']; ?></td>
                                    <td><?= $role['sort']; ?></td>
                                    <td>
                                        <a href="<?= base_url('role/roleakses'); ?>/<?= $role['id']; ?>" class="badge badge-warning"><i class="fas fa-fw fa-sign-in-alt"></i></a>

                                        <?php if ($role['role_kode'] != 'ADMIN') : ?>
                                            <a href="" class="badge badge-info" data-toggle="modal" data-target="#editRoleModal<?= $role['id']; ?>"><i class="far fa-fw fa-edit"></i></a>
                                            <a type="submit" href="" class="badge badge-danger deleterole"><i class="fas fa-fw fa-trash-alt"></i></a>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                                <?php $i++; ?>
                                <!-- Modal Edit menu -->
                                <div class="modal fade" id="editRoleModal<?= $role['id']; ?>" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('/role/editrole'); ?>/<?= $role['id']; ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="menu" class="col-sm-2 col-form-label">Kode Role</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="role_kode" placeholder="Kode Role" value="<?= $role['role_kode']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="icon" class="col-sm-2 col-form-label">Role</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="role" placeholder="Role" value="<?= $role['role']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="menu" class="col-sm-2 col-form-label">Sort</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="sort" placeholder="Sort Menu" value="<?= $role['sort']; ?>">
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