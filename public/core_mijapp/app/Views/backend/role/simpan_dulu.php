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