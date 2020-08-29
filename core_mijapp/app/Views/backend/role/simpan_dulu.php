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