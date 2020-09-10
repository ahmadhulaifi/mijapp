<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>


<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <form action="" method="post" id="tambahpegawaiform" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h4 class="card-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> Info Pribadi
                                </a>
                            </h4>
                        </div>

                        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Data : </th>
                                            <th>Nilai : </th>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Nama lengkap *: </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-12">
                                                            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap *" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="nama_panggilan" placeholder="Nama Panggilan *" class="form-control">
                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="gelar" placeholder="Gelar belakang" class="form-control">

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tempat &amp; Tanggal lahir * : </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="tem_lahir" placeholder="Tempat lahir" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="date" name="tgl_lahir" placeholder="Tanggal lahir" class="form-control" id="date">
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Jenis kelamin * : </td>
                                                <td>
                                                    <select name="j_kel" class="form-control">
                                                        <option selected disabled>--- Jenis Kelamin ---</option>
                                                        <option value="laki-laki">Laki-Laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Agama * : </td>
                                                <td>
                                                    <select name="agama" class="form-control">
                                                        <option selected disabled>--- Agama ---</option>
                                                        <option value="islam">Islam</option>
                                                        <option value="kristen protestan">Kristen Protestan</option>
                                                        <option value="kristen katolik">Kristen Katolik</option>
                                                        <option value="hindu">Hindu</option>
                                                        <option value="buddha">Buddha</option>
                                                        <option value="konghucu">Konghucu</option>
                                                    </select>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Status : </td>
                                                <td>
                                                    <input type="text" name="status" placeholder="Status" class="form-control">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">


                        <div class="card-header" role="tab" id="headingTwo">
                            <h4 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> Info Kontak
                                </a>
                            </h4>
                        </div>

                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Data : </th>
                                            <th>Nilai : </th>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Username * : </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-12">
                                                            <input type="text" name="username" placeholder="Username" class="form-control">

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password * : </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-12">
                                                            <input type="password" name="password" placeholder="Password" class="form-control">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-12">
                                                            <input type="password" name="repassword" placeholder="Re-Type Password" class="form-control">

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr id="alamatAsal">
                                                <td>Alamat asal : </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-4">
                                                            <input type="text" name="jalan_no" placeholder="Jalan dan Nomer rumah " class="form-control">
                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-4">
                                                            <input type="text" name="rt" placeholder="RT" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-4">
                                                            <input type="text" name="rw" placeholder="RW" class="form-control">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="desa_kel" placeholder="Kelurahan / Desa" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="kecamatan" placeholder="Kecamatan " class="form-control">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="kota" placeholder="Kota" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="number" name="kode_pos" placeholder="Kode pos" class="form-control">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="checkbox col-xs-12">
                                                            <label>
                                                                <input type="checkbox" name="domisili" value="true" id="domisili">
                                                                Apakah alamat domisili Anda berbeda dengan alamat asal?
                                                            </label>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                            <tr id="alamatDomisili">
                                                <td>Alamat domisili : </td>
                                                <td>

                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-4">
                                                            <input type="text" name="jalan_no_domisili" placeholder="Jalan dan Nomer rumah " class="form-control">
                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-4">
                                                            <input type="text" name="rt_domisili" placeholder="RT" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-4">
                                                            <input type="text" name="rw_domisili" placeholder="RW" class="form-control">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="desa_kel_domisili" placeholder="Kelurahan / Desa" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="kecamatan_domisili" placeholder="Kecamatan " class="form-control">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="text" name="kota_domisili" placeholder="Kota" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <input type="number" name="kode_pos_domisili" placeholder="Kode pos" class="form-control">

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Email : </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="email" name="email" placeholder="Email" class="form-control">

                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Nomer telepon: </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="telepon" placeholder="Nomer telepon" class="form-control">

                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Nomer KTP : </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="ktp" placeholder="Nomer KTP" class="form-control">

                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Nomer kartu keluarga : </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="no_kk" placeholder="kartu keluarga" class="form-control">

                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Foto profile : </td>
                                                <td>

                                                    <div class="col-sm-2">
                                                        <img src="" class="img-thumbnail img-preview">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input " id="foto" name="foto" onchange="previewImg()">
                                                            <label class="custom-file-label" for="foto"></label>
                                                            <!-- <input type="hidden" name="fotoLama"> -->
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                            <h4 class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                                    Info Pekerjaan
                                </a>
                            </h4>
                        </div>

                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>Data : </th>
                                            <th>Nilai : </th>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>NIP * : </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="nip" placeholder="NIP" class="form-control">

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status Pegawai * : </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <select name="jabatan_kode" class="form-control">
                                                                <option selected disabled>--- Kode Jabatan ---</option>

                                                                <?php foreach ($jabatan as $jabatan) : ?>
                                                                    <option value="<?= $jabatan['jabatan_kode']; ?>"><?= $jabatan['jabatan_kode']; ?></option>
                                                                <?php endforeach; ?>

                                                            </select>
                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <select name="status_pegawai_kode" class="form-control">
                                                                <option selected disabled>--- Kode Status ---</option>

                                                                <?php foreach ($status as $status) : ?>
                                                                    <option value="<?= $status['status_pegawai_kode']; ?>"><?= $status['status_pegawai_kode']; ?></option>
                                                                <?php endforeach; ?>

                                                            </select>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tanggal mulai bekerja * : </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="date" name="tgl_mulai_bekerja" placeholder="Mulai bekerja" class="form-control" id="date1">

                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Nomer NPWP : </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="no_npwp" placeholder="No npwp" class="form-control">

                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Nomer BPJS : </td>
                                                <td>
                                                    <div class="row">

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <label for="no_bpjs_ketenagakerjaan">BPJS Tenaga Kerja</label>
                                                            <input type="text" name="no_bpjs_ketenagakerjaan" placeholder="Nomer BPJS Ketenagakerjaan" class="form-control">
                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <label for="no_bpjs_kesehatan">BPJS Kesehatan</label>
                                                            <input type="text" name="no_bpjs_kesehatan" placeholder="Nomer BPJS Kesehatan" class="form-control">

                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Akun Bank : </td>
                                                <td>
                                                    <div class="row">

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <label for="bank">Nama Bank </label>
                                                            <input type="text" name="bank" placeholder="Nama Bank" class="form-control">

                                                        </div>

                                                        <div class="form-group col-xs-12 col-sm-6">
                                                            <label for="no_rekening">No Rekening </label>
                                                            <input type="text" name="no_rekening" placeholder="Nomor Rekening" class="form-control">

                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <br>

                <span>Note (*) harus diisi.</span><br><br>
                <input type="submit" name="submit" value="Simpan" class="btn btn-primary btn-block">
                <br><br>

            </div>
        </form>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    function previewImg() {
        let foto = document.querySelector('#foto');
        let fotoLabel = document.querySelector('.custom-file-label');
        let imgPreview = document.querySelector('.img-preview');

        fotoLabel.textContent = foto.files[0].name;

        let fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<script>
    $(document).ready(function() {



        $('#alamatDomisili').hide();
        $("#domisili").on('click', function() {
            $('#alamatDomisili').slideToggle();
        });

        // tambah pegawai
        $("#tambahpegawaiform").submit(function(event) {
            event.preventDefault();


            $.ajax({
                url: '<?= base_url(); ?>/pegawai/tambahpegawai',
                type: 'post',

                data: new FormData(this),
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.responce == "success") {
                        // console.log(data.update);
                        toastr["success"](data.pesan);
                        window.location = '<?= base_url(); ?>/pegawai'
                    } else {
                        toastr["error"](data.pesan);
                        // console.log(data);
                    }
                }
            });


        });
    });
</script>

<?= $this->endSection(); ?>