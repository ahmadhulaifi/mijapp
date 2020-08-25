<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('pesanError')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('pesanError'); ?>
                    </div>
                <?php endif; ?>
                <h4>Status : <span class="btn btn-success"><?= $member['role']; ?></span></h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Sort</th>
                                <th scope="col">Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($menu as $m) : ?>
                                <?php $mem = $member['role_kode'] ?>
                                <?php if ($member['role'] != 'Admin' || $m['menu'] != 'Menu') : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $m['menu']; ?></td>
                                        <td><?= $m['sort']; ?></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input akses" type="checkbox" data-role="<?= $mem; ?>" data-menu="<?= $m['id']; ?>" value="" id="akses" <?= checkaccess($mem, $m['id']); ?>>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
</div>