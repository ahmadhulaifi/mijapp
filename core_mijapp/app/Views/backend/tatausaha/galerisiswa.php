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


                <!-- Modal -->
                <div class="modal fade" id="galeriModal" tabindex="-1" aria-labelledby="galeriModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="galeriModalLabel">Upload Foto Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Data -->
                                <form action="" method="POST" id="uploadfotosiswa" enctype="multipart/form-data">

                                    <div class="form_group" style="margin-bottom: 5;">
                                        <label for="">Unggah File</label>
                                        <input type="file" id="filesiswa" name="filesiswa" class="form-control">
                                    </div>
                                    <br>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnimportsiswa" class="btn btn-primary">Upload</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Galeri Foto divisi
                        </div>
                        <div class="card-tools">
                            <button type="button" id="btnuploadfotobaru" class="btn btn-default" data-toggle="modal" data-target="#galeriModal">
                                Upload Gambar
                            </button>
                        </div>
                    </div>
                    <?php
                    ?>
                    <div class="card-body">
                        <div>
                            <div class="btn-group w-100 mb-2">
                                <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>
                                <?php foreach ($divisi as $divisi) : ?>
                                    <?php if ($divisi['divisi'] != 'Umum') : ?>



                                        <a class="btn btn-info" href="javascript:void(0)" data-filter="<?= strtolower(substr($divisi['divisi'], 0, 2)); ?>">Kls <?= $divisi['divisi']; ?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>



                            </div>
                            <div class="mb-2">
                                <!-- <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a> -->
                                <div class="float-right">
                                    <select class="custom-select" style="width: auto;" data-sortOrder>
                                        <option value=”title”> Title </option>
                                        <option value="index"> Sort by Position </option>
                                        <option value="sortData"> Sort by Custom Data </option>
                                    </select>
                                    <div class="btn-group">
                                        <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                                        <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="text" name="filtr-search" class="form-control" value="" placeholder="Cari gambar" data-search="">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div>
                            <div class="filter-container p-0 row">

                                <?php foreach ($galerisiswa as $galerisiswa) : ?>
                                    <?php if ($galerisiswa != 'default.png') { ?>

                                        <div class="filtr-item col-sm-2" data-category="<?= strtolower(substr($galerisiswa, 0, 2)); ?>">
                                            <div class="card">
                                                <input type="checkbox" style="position: relative;top: 10px;" name="checkbox" id="<?= $galerisiswa; ?>" value="<?= $galerisiswa; ?>" class="delete_checkbox"></input>
                                                <label for="myCheckbox1">
                                                    <img src="<?= base_url(); ?>/asset/images/siswa/<?= $galerisiswa; ?>" class="card-img-top mb-2" alt="white sample">
                                                </label>
                                                <div class="card-body">
                                                    <center>
                                                        <p class="card-text"><?= $galerisiswa; ?></p>
                                                        <a href="#" class="btn btn-danger">Delete</a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }; ?>
                                <?php endforeach; ?>

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
<script>
    $(function() {


        $('.filter-container').filterizr({
            gutterPixels: 3
        });
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })
</script>

<script>
    $(document).ready(function() {






        $('.delete_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });



        $('#deletefotogaleri').click(function() {

            var checkbox = $('.delete_checkbox:checked');

            if (checkbox.length > 0) {
                Swal.fire({
                    title: 'Apa kamu yakin ingin menghapus ' + checkbox.length + ' foto siswa?',
                    text: "kamu tidak akan bisa mengembalikannya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus saja!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        var checkbox_value = [];
                        $(checkbox).each(function() {
                            checkbox_value.push($(this).val());
                        });

                        // console.log(checkbox);
                        $.ajax({
                            url: '<?= base_url('/tatausaha/deletefotochecksiswa'); ?>',
                            type: "POST",
                            data: {
                                checkbox_value: checkbox_value
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.responce == "success") {
                                    // toastr["success"](data.pesan);
                                    Swal.fire(
                                        'Deleted!',
                                        'Foto berhasil dihapus.',
                                        'success'
                                    )
                                    $('#tableSiswa').DataTable().destroy();
                                    fetchSiswa();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Ada yang tidak beres!',
                                    })
                                }
                            }
                        })

                    }
                })

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih minimal satu data',
                })

            }
        });
    })
</script>

<?= $this->endSection(); ?>