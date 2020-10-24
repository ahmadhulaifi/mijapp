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
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>
                                <?php if ($divisi['divisi'] == 'Umum') {
                                    echo 'Semua';
                                } else {
                                    echo $divisi['divisi'];
                                } ?>

                            </h3>

                            <h4>
                                <?php
                                $id_divisi = $divisi['id'];
                                $cek3 = count(array_keys($jmlsiswadivisi, $id_divisi)); ?>

                                <?php
                                if ($id_divisi == 1) {
                                    echo $jmlhsiswaall;
                                } else {
                                    echo $cek3;
                                }
                                ?> Siswa
                            </h4>

                        </div>
                        <div class="icon">
                            <i class="fas fa-fw fa-user-graduate"></i>
                        </div>
                        <a href="<?= base_url(); ?>/tatausaha/daftaralumni/<?= $divisi['id']; ?>" class="small-box-footer">Lihat Alumni <i class="fas fa-arrow-circle-right"></i></a>
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