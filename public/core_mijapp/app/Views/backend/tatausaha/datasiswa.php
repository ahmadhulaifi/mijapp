<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <?php foreach ($divisi as $divisi) : ?>
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $divisi['divisi']; ?></h3>
                            <h4>
                                <?php
                                $id_divisi = $divisi['id'];
                                // dd($rombel);
                                $cek = count(array_keys($kelas, $id_divisi));

                                ?>
                                <?php
                                if ($id_divisi == 1) {
                                    echo $jmlhkelas;
                                } else {
                                    echo $cek;
                                }
                                ?> Kelas
                            </h4>
                            <h5>

                                <?php $cek2 = count(array_keys($rombel, $id_divisi)); ?>

                                <?php
                                if ($id_divisi == 1) {
                                    echo $jmlhrombel;
                                } else {
                                    echo $cek2;
                                }
                                ?> Rombel
                            </h5>
                            <h5>
                                <?php $cek3 = count(array_keys($jmlsiswadivisi, $id_divisi)); ?>

                                <?php
                                if ($id_divisi == 1) {
                                    echo $jmlhsiswaall;
                                } else {
                                    echo $cek3;
                                }
                                ?> Siswa
                            </h5>

                        </div>
                        <div class="icon">
                            <i class="fa fa-fw fa-users"></i>
                        </div>
                        <a href="<?= base_url(); ?>/tatausaha/daftarsiswa/<?= $divisi['id']; ?>" class="small-box-footer">Lihat Siswa <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>