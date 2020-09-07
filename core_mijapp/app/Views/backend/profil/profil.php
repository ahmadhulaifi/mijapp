<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="container">
            <div class="main-body">

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?= base_url(); ?>/asset/images/user/<?= $user['foto']; ?>" alt="gambar profil" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?= $user['nama_panggilan']; ?></h4>
                                        <p class="text-secondary mb-1">NIP: <?= $user['nip']; ?></p>
                                        <p class="text-secondary mb-1">Jabatan: <span class="badge badge-primary"><?= $user['jabatan']; ?></span></p>
                                        <p class="text-secondary mb-1">Divisi:
                                            <?php foreach ($divisi as $divisi) : ?>
                                                <span class="badge badge-info"><?= $divisi['divisi']; ?></span>
                                            <?php endforeach; ?>
                                        </p>
                                        <p class="text-secondary mb-1">Status: <span class="badge badge-warning"><?= $user['status_pegawai']; ?></span></p>
                                        <p class="text-secondary mb-1">Tgl Mulai Bekerja: <span class="badge badge-success"><?= tgl_indo($user['tgl_mulai_bekerja']); ?></span></p>
                                        <p class="text-secondary mb-1">Hak Akses: <span class="badge badge-danger"><?= $user['role_kode']; ?></span></p><br>

                                        <p>Alamat lengkap</p>
                                        <?php if ($user['jalan_no'] == null) { ?>
                                            <p class="text-muted font-size-sm">Alamat belum diisi</p>
                                        <?php
                                        } else { ?>
                                            <p class="text-muted font-size-sm"><?= $user['jalan_no']; ?>, Rt.<?= $user['rt']; ?>/<?= $user['rw']; ?> Kel.<?= $user['desa_kel']; ?> Kecamatan <?= $user['kecamatan']; ?> <?= $user['kota']; ?>, <?= $user['kd_pos']; ?></p>
                                        <?php
                                        } ?>

                                        <?php if ($user['jalan_no_domisili'] != null) : ?>
                                            <p>Alamat Domisili</p>
                                            <p class="text-muted font-size-sm"><?= $user['jalan_no_domisili']; ?>, Rt.<?= $user['rt_domisili']; ?>/<?= $user['rw_domisili']; ?> Kel.<?= $user['desa_kel_domisili']; ?> Kecamatan <?= $user['kecamatan_domisili']; ?> <?= $user['kota_domisili']; ?>, <?= $user['kd_pos_domisili']; ?></p>
                                        <?php endif; ?>

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Ganti Password</button>
                                        <a href="<?= base_url(); ?>/profil/editprofil/<?= $user['id']; ?>" class="btn btn-outline-primary">Edit Profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['username']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Lengkap</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['nama_lengkap']; ?>
                                        <?php if ($user['gelar'] != null) {
                                            echo ', ' . $user['gelar'];
                                        } ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['email']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Jenis Kelamin</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['j_kel']; ?>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tempat lahir</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $user['tem_lahir']; ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tanggal lahir</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= tgl_indo($user['tgl_lahir']); ?>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Agama</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $user['agama']; ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $user['status']; ?>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No.KTP</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $user['no_ktp']; ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No.KK</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $user['no_kk']; ?>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No.NPWP</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['no_npwp']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No.BPJS Tenaga Kerja</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['no_bpjs_ketenagakerjaan']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No.BPJS Kesehatan</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['no_bpjs_kesehatan']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Bank</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $user['bank']; ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No Rekening</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $user['no_rek']; ?>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Telepon</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user['telepon']; ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>




    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal Edit Password -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Edit Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="editpasswordform">
                    <input type="hidden" name="idkaryawan" value="<?= $user['id']; ?>">
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword3" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword4" class="col-sm-4 col-form-label">Retype-Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword4" name="repassword">
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

<script>
    $(document).ready(function() {
        // edit password
        $('#editpasswordform').submit(function() {
            event.preventDefault();
            // let idkaryawan = $("input[name='id_karyawan']").val();
            // console.log(idkaryawan)

            $.ajax({
                url: '<?= base_url('/profil/editpassword'); ?>',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.responce == "success") {
                        $('#passwordModal').modal('hide');
                        toastr["success"](data.pesan);
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                }
            });
        });
    });
</script>


<?= $this->endSection(); ?>