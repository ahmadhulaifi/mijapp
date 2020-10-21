<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="container">
            <div class="main-body">

                <center>
                    <h3>Data Siswa Madrasah Istiqlal Jakarta</h3>
                </center><br>
                <div class="row gutters-sm">
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?= base_url(); ?>/asset/images/siswa/<?= $siswa['foto']; ?>" alt="gambar profil" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?= $siswa['nama_lengkap']; ?></h4>
                                        <p class="text-secondary mb-1">NIK: <?= $siswa['nik']; ?></p>
                                        <p class="text-secondary mb-1">NISN: <?= $siswa['nisn']; ?></p>
                                        <p class="text-secondary mb-1">Rombel: <?= $siswa['rombel']; ?></p>
                                        <p class="text-secondary mb-1">Kelas: <?= $siswa['kelas']; ?></p>
                                        <p class="text-secondary mb-1">Divisi: <?= $siswa['divisi']; ?></p>

                                        <br>

                                        <p>Alamat lengkap</p>
                                        <?php if ($siswa['alamat'] == null) { ?>
                                            <p class="text-muted font-size-sm">Alamat belum diisi</p>
                                        <?php
                                        } else { ?>
                                            <p class="text-muted font-size-sm"><?= $siswa['alamat']; ?></p>
                                        <?php
                                        } ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['username']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Lengkap</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['nama_lengkap']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Panggilan</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['panggilan']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Jenis Kelamin</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['j_kel']; ?>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tempat lahir</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?= $siswa['tem_lahir']; ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tanggal lahir</h6>
                                    </div>
                                    <div class="col-sm-3 text-secondary">
                                        <?php if ($siswa['tgl_lahir'] != 0) {
                                            echo tgl_indo($siswa['tgl_lahir']);
                                        } else {
                                            echo "";
                                        } ?>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Lanjut Sekolah</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['lanjut_sekolah']; ?>
                                    </div>


                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tahun Lulus</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['tahun_lulus']; ?>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Ayah</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['ayah']; ?>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Pekerjaan Ayah</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['pekerjaan_ayah']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Pendapatan Ayah</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['pendapatan_ayah']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Ibu</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['ibu']; ?>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Pekerjaan Ibu</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['pekerjaan_ibu']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Pendapatan Ibu</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['pendapatan_ibu']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No.Hp</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $siswa['no_hp']; ?>
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





<?= $this->endSection(); ?>