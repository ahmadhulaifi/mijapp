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

                <?php
                if ($iddivisii != 1) {
                ?>
                    <button type="button" id="btntambahsiswabaru" class="btn btn-success" data-toggle="modal" data-target="#siswaModal">
                        Tambah Siswa
                    </button>
                    <button type="button" name="btn_deletesiswa" id="deletesiswa" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importModal">
                        Import
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#uploadModal">
                        Upload Foto
                    </button>
                <?php
                }
                ?>


                <input type="hidden" disabled id="iddivisicek" value="<?= $divisi['id']; ?>">

                <!-- Modal -->
                <div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="siswaModalLabel">Tambah Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="tambahsiswaform">
                                    <?= csrf_field(); ?>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary" data-toggle='collapse' data-parent='#accordion' id="btndatasiswaform">Data Siswa</button>
                                            <button type="button" class="btn btn-primary" data-toggle='collapse' data-parent='#accordion' id="btndataorangtuaform">Data Orangtua</button>
                                        </div>
                                    </center>
                                    <br>
                                    <div class='panel-group' id='accordion'>
                                        <div class='panel panel-default'>
                                            <!-- <div class='panel-heading'>
                                                <h4 class='panel-title'>
                                                    <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'><span class='glyphicon glyphicon-file'>
                                                        </span>Data Siswa</a>
                                                </h4>
                                            </div> -->
                                            <div id='collapseOne' class='panel-collapse collapse show in'>
                                                <div class='panel-body'>
                                                    <div class='row'>
                                                        <div class="col-12">

                                                            <input type="hidden" class="form-control" name="last_user_update" value="<?= $user['nama_lengkap']; ?>">
                                                            <input type="hidden" class="form-control" name="id_divisi" value="<?= $divisi['id']; ?>">
                                                            <div class="form-group row">
                                                                <label for="username" class="col-sm-3 col-form-label">Username <span style="color: red;">*</span> </label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="username">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="password" class="col-sm-3 col-form-label">Password<span style="color: red;">*</span></label>
                                                                <div class="col-sm-9">
                                                                    <input type="password" class="form-control" name="password">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="repassword" class="col-sm-3 col-form-label">Re-Password<span style="color: red;">*</span></label>
                                                                <div class="col-sm-9">
                                                                    <input type="password" class="form-control" name="repassword">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nik" class="col-sm-3 col-form-label">NIK<span style="color: red;">*</span></label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="nik">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="nisn">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span style="color: red;">*</span></label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="nama_lengkap">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="panggilan" class="col-sm-3 col-form-label">Panggilan</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="panggilan">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="j_kel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                                <div class="col-sm-9">
                                                                    <!-- <input type="text" class="form-control" name="j_kel"> -->
                                                                    <select id="j_kel" name="j_kel" class="form-control">
                                                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                                                        <option value="laki-laki">laki-Laki</option>
                                                                        <option value="perempuan">perempuan</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="tem_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="tem_lahir">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tgl lahir</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" class="form-control" name="tgl_lahir">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="tahun_lulus">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="lanjut_sekolah" class="col-sm-3 col-form-label">lanjut Sekolah</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="lanjut_sekolah">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                                                                <div class="col-sm-9">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImg()">
                                                                        <label class="custom-file-label" for="foto"></label>
                                                                        <!-- <input type="hidden" name="fotoLama"> -->
                                                                    </div>
                                                                    <div class="col-sm-10">
                                                                        <img src="" class="img-thumbnail img-preview">
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class='panel panel-default'>
                                            <!-- <div class='panel-heading'>
                                                <h4 class='panel-title'>
                                                    <a data-toggle='collapse' data-parent='#accordion' href='#collapseTwo'><span class='glyphicon glyphicon-th-list'>
                                                        </span>Data Orangtua</a>
                                                </h4>
                                            </div> -->
                                            <div id='collapseTwo' class='panel-collapse collapse'>
                                                <div class='panel-body'>
                                                    <div class="form-group row">
                                                        <label for="ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="ayah">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="pekerjaan_ayah">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pendapatan_ayah" class="col-sm-3 col-form-label">Pendapatan Ayah</label>
                                                        <div class="col-sm-9">
                                                            <select id="pendapatan_ayah" name="pendapatan_ayah" class="form-control">
                                                                <option value="">-- Pilih Pendapatan --</option>
                                                                <option value="tidak ada">Tidak ada</option>
                                                                <option value="< 5 Juta"> &lt 5 Juta</option>
                                                                <option value="5-8 Juta">5-8 Juta</option>
                                                                <option value="8-15 Juta">8-15 Juta</option>
                                                                <option value="15-20 Juta">15-20 Juta</option>
                                                                <option value="20-30 Juta">20-30 Juta</option>
                                                                <option value="> 30 Juta">&gt 30 Juta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="ibu">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="pekerjaan_ibu">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pendapatan_ibu" class="col-sm-3 col-form-label">Pendapatan Ibu</label>
                                                        <div class="col-sm-9">
                                                            <select id="pendapatan_ibu" name="pendapatan_ibu" class="form-control">
                                                                <option value="">-- Pilih Pendapatan --</option>
                                                                <option value="tidak ada">Tidak ada</option>
                                                                <option value="< 5 Juta"> &lt 5 Juta</option>
                                                                <option value="5-8 Juta">5-8 Juta</option>
                                                                <option value="8-15 Juta">8-15 Juta</option>
                                                                <option value="15-20 Juta">15-20 Juta</option>
                                                                <option value="20-30 Juta">20-30 Juta</option>
                                                                <option value="> 30 Juta">&gt 30 Juta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                                        </div>



                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="no_hp" class="col-sm-3 col-form-label">No.HP</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="no_hp">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnsavesiswa" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="editsiswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="siswaModalLabel">Edit Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="" id="editsiswaform">
                                    <?= csrf_field(); ?>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary" data-toggle='collapse' data-parent='#accordion' id="btneditdatasiswaform">Data Siswa</button>
                                            <button type="button" class="btn btn-primary" data-toggle='collapse' data-parent='#accordion' id="btneditdataorangtuaform">Data Orangtua</button>
                                        </div>
                                    </center>
                                    <br>
                                    <div class='panel-group' id='accordion'>
                                        <div class='panel panel-default'>
                                            <!-- <div class='panel-heading'>
                                                <h4 class='panel-title'>
                                                    <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'><span class='glyphicon glyphicon-file'>
                                                        </span>Data Siswa</a>
                                                </h4>
                                            </div> -->
                                            <div id='collapseOneEdit' class='panel-collapse collapse show in'>
                                                <div class='panel-body'>
                                                    <div class='row'>
                                                        <div class="col-12">

                                                            <input type="hidden" class="form-control" name="idsiswa">
                                                            <input type="hidden" class="form-control" name="last_user_update" value="<?= $user['nama_lengkap']; ?>">
                                                            <input type="hidden" class="form-control" name="id_divisi" value="<?= $divisi['id']; ?>">
                                                            <div class="form-group row">
                                                                <label for="username" class="col-sm-3 col-form-label">Username <span style="color: red;">*</span> </label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="username">
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label for="nik" class="col-sm-3 col-form-label">NIK<span style="color: red;">*</span></label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="nik">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="nisn">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap<span style="color: red;">*</span></label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="nama_lengkap">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="panggilan" class="col-sm-3 col-form-label">Panggilan</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="panggilan">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="j_kel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                                                <div class="col-sm-9">
                                                                    <!-- <input type="text" class="form-control" name="j_kel"> -->
                                                                    <select id="editj_kel" name="j_kel" class="form-control">


                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="tem_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="tem_lahir">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tgl lahir</label>
                                                                <div class="col-sm-9">
                                                                    <input type="date" class="form-control" name="tgl_lahir">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="tahun_lulus" class="col-sm-3 col-form-label">Tahun Lulus</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="tahun_lulus">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="lanjut_sekolah" class="col-sm-3 col-form-label">lanjut Sekolah</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" name="lanjut_sekolah">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                                                                <div class="col-sm-9">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="editfoto" name="foto" onchange="editpreviewImg()">
                                                                        <label id="labeleditfoto" class="custom-file-label" for="foto"></label>
                                                                        <input type="hidden" id="editfotolama" name="fotoLama" value="">
                                                                    </div>
                                                                    <div class="col-sm-10">
                                                                        <img id="editpreviewfoto" class="img-thumbnail img-preview">
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class='panel panel-default'>
                                            <!-- <div class='panel-heading'>
                                                <h4 class='panel-title'>
                                                    <a data-toggle='collapse' data-parent='#accordion' href='#collapseTwo'><span class='glyphicon glyphicon-th-list'>
                                                        </span>Data Orangtua</a>
                                                </h4>
                                            </div> -->
                                            <div id='collapseTwoEdit' class='panel-collapse collapse'>
                                                <div class='panel-body'>
                                                    <div class="form-group row">
                                                        <label for="ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="ayah">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pekerjaan_ayah" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="pekerjaan_ayah">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pendapatan_ayah" class="col-sm-3 col-form-label">Pendapatan Ayah</label>
                                                        <div class="col-sm-9">
                                                            <select id="editpendapatan_ayah" name="pendapatan_ayah" class="form-control">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="ibu">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pekerjaan_ibu" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="pekerjaan_ibu">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="pendapatan_ibu" class="col-sm-3 col-form-label">Pendapatan Ibu</label>
                                                        <div class="col-sm-9">
                                                            <select id="editpendapatan_ibu" name="pendapatan_ibu" class="form-control">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id="editalamat" name="alamat" rows="3"></textarea>
                                                        </div>



                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="no_hp" class="col-sm-3 col-form-label">No.HP</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="no_hp">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="editbtnsavesiswa" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- modal import -->
                <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Data Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Data -->
                                <form action="" method="POST" id="importsiswa" enctype="multipart/form-data">
                                    <input type="hidden" name="iddivisi" value="<?= $divisi['id']; ?>">
                                    <div class="form_group" style="margin-bottom: 5;">
                                        <label for="">Unggah File</label>
                                        <input type="file" id="filesiswa" name="filesiswa" class="form-control">
                                    </div>
                                    <br>
                                    <p style="font-size: 15px;"><a href="<?= base_url(); ?>/asset/template/template_import_siswa.xls">Download Template Import Siswa</a></p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnimportsiswa" class="btn btn-primary">Import</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- modal Upload foto -->
                <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Upload Foto Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah Data -->
                                <form action="" method="POST" id="uploadfotosiswa" enctype="multipart/form-data">
                                    <div class="form_group" style="margin-bottom: 5;">
                                        <label for="">Unggah File</label>
                                        <input type="file" id="fileuploadfoto" name="fileuploadfoto" class="form-control">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnuploadfotosiswa" class="btn btn-primary">Upload</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-5">
                <div class="form-group row">
                    <label for="bulan" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="searchkelas" name="searchkelas"> -->
                        <select id="searchkelas" name="searchkelas" class="form-control">
                            <option id="selectkelassemua" selected value="semua">Semua</option>
                            <option value="belum">Belum Diatur</option>
                            <?php foreach ($kelas as $kelas) : ?>
                                <option value="<?= $kelas['id']; ?>"><?= $kelas['kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label for="tahun" class="col-sm-2 col-form-label">Rombel</label>
                    <div class="col-sm-4">
                        <!-- <input type="text" class="form-control" id="searchrombel" name="searchrombel"> -->
                        <select id="searchrombel" name="searchrombel" class="form-control">
                            <option id="selectrombelsemua" selected value="semua">Semua</option>
                            <option value="belum">Belum Diatur</option>
                            <?php foreach ($rombel as $rombel) : ?>
                                <option value="<?= $rombel['id']; ?>"><?= $rombel['rombel']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <input name="role_kode_hidden" type="hidden" value="<?= session('role_kode'); ?>">
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped" id="tableSiswa">
                        <thead class="bg-success">
                            <tr>
                                <th><input type="checkbox" id='checkall'></th>
                                <!-- <th scope="col">No</th> -->
                                <th scope="col">Action</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Username</th>

                                <th scope="col">NIK</th>
                                <th scope="col">NISN</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Panggilan</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tempat lahir</th>
                                <th scope="col">Tanggal lahir</th>
                                <th scope="col">Rombel</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Tahun Lulus</th>
                                <th scope="col">Lanjut Sekolah</th>
                                <th scope="col">Nama Ayah</th>
                                <th scope="col">Pekerjaan Ayah</th>
                                <th scope="col">Pendapatan Ayah</th>
                                <th scope="col">Nama Ibu</th>
                                <th scope="col">Pekerjaan Ibu</th>
                                <th scope="col">Pendapatan Ibu</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No.HP</th>
                                <th scope="col">Last User Update</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>

                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>


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
                            <input type="hidden" name="idsiswapassword">
                            <div class="row">
                                <label for="Nama" class="col-sm-4">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <p id="namapassword"></p>
                                </div>
                            </div>
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

    function editpreviewImg() {
        let foto = document.querySelector('#editfoto');
        let fotoLabel = document.querySelector('#labeleditfoto');
        let imgPreview = document.querySelector('#editpreviewfoto');

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


        $('#btndatasiswaform').on('click', function() {
            // do something...
            $('#collapseOne').addClass('show')
            $('#collapseTwo').removeClass('show')
        })

        $('#btndataorangtuaform').on('click', function() {
            // do something...
            $('#collapseOne').removeClass('show')
            $('#collapseTwo').addClass('show')
        })

        $('#btneditdatasiswaform').on('click', function() {
            // do something...
            $('#collapseOneEdit').addClass('show')
            $('#collapseTwoEdit').removeClass('show')
        })

        $('#btneditdataorangtuaform').on('click', function() {
            // do something...
            $('#collapseOneEdit').removeClass('show')
            $('#collapseTwoEdit').addClass('show')
        })

        $('#btntambahsiswabaru').on('click', function() {
            // do something...
            $('#tambahsiswaform')[0].reset();
            $('foto').val('');
            // document.getElementById("foto").value = "";
        })

        function tabelsiswa(dataks, datab) {
            let divisii = datab;
            $('#tableSiswa').DataTable({
                "data": dataks,
                "responsive": true,
                "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "buttons": [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-fw fa-copy"></i>',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-fw fa-file-excel"></i>',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-fw fa-file-pdf"></i>',
                        titleAttr: 'Pdf'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-fw fa-print"></i>',
                        titleAttr: 'Print'
                    },
                    {
                        extend: 'colvis',
                        text: '',
                        titleAttr: 'Colvis'
                    }
                ],
                columnDefs: [{
                    targets: [2, 3, 8, 9, 10, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26],
                    visible: false
                }],

                "columns": [

                    {
                        targets: 0,
                        data: null,
                        className: 'text-center',
                        searchable: false,
                        orderable: false,


                        "render": function(data, type, row, meta) {
                            var r =
                                '<input type="checkbox" name="checkbox" id = "' + row.id + '"  value = "' + row.id + '" class="delete_checkbox"></input>';

                            return r;
                        },
                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            let a = '';

                            if (divisii == 1) {
                                a = ``;
                            } else {
                                a = `
                                    <a type="button" value="${row.id}" class="badge badge-info editsiswa"><i class="far fa-fw fa-edit"></i></a>
                                    <a type="button" value="${row.id}/${row.nama_lengkap}" class="badge badge-warning passwordsiswa"><i class="fas fa-fw fa-lock"></i></a>`;
                            }


                            return a;
                        }
                    },
                    {
                        "data": "foto",
                        "render": function(data, type, row, meta) {

                            let a = `<img src="<?= base_url(); ?>/asset/images/siswa/${data}">`;

                            return a;
                        }
                    },
                    {
                        "data": "username"
                    },

                    {
                        "data": "nik"
                    },

                    {
                        "data": "nisn"
                    },
                    {
                        "data": "nama_lengkap"
                    },
                    {
                        "data": "panggilan"
                    },
                    {
                        "data": "j_kel"
                    },
                    {
                        "data": "tem_lahir"
                    },
                    {
                        // "data": "tem_lahir"
                        "data": null,
                        "render": function(data, type, row, meta) {

                            let a = tanggalindo(`${row.tgl_lahir}`);

                            return a;
                        }
                    },
                    {
                        "data": "rombel",
                        "render": function(data, type, row, meta) {

                            let a = '';

                            if (data == null) {
                                a = 'Belum Diatur';
                            } else {
                                a = data;
                            }

                            return a;
                        }
                    },
                    {
                        "data": "kelas",
                        "render": function(data, type, row, meta) {

                            let a = '';

                            if (data == null) {
                                a = 'Belum Diatur';
                            } else {
                                a = data;
                            }

                            return a;
                        }
                    },
                    {
                        "data": "divisi"
                        // "render": function(data, type, row, meta) {

                        //     let a = '';

                        //     if (data == null) {
                        //         a = 'Belum Diatur';
                        //     } else {
                        //         a = data;
                        //     }

                        //     return a;
                        // }
                    },
                    {
                        "data": "tahun_lulus"
                    },
                    {
                        "data": "lanjut_sekolah"
                    },

                    {
                        "data": "ayah"
                    },
                    {
                        "data": "pekerjaan_ayah"
                    },
                    {
                        "data": "pendapatan_ayah"
                    },
                    {
                        "data": "ibu"
                    },
                    {
                        "data": "pekerjaan_ibu"
                    },
                    {
                        "data": "pendapatan_ibu"
                    },


                    {
                        "data": "alamat"
                    },
                    {
                        "data": "no_hp"
                    },
                    {
                        "data": "last_user_update"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "updated_at"
                    }

                ]
            });
        }


        //fetch Siswa Semua
        function fetchSiswa() {
            let id_divisi = $('#iddivisicek').attr('value');
            // console.log(id_divisi)
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/fetchsiswa',
                type: 'post',
                data: {
                    id_divisi: id_divisi
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    // console.log(data.siswa);
                    // let divisii = data.divisi
                    let i = "1";
                    tabelsiswa(data.siswa, data.divisi);
                }
            });
        }

        //fetch Siswa Semua
        function fetchSiswaBelum() {
            let id_divisi = $('#iddivisicek').attr('value');
            // console.log(id_divisi)
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/fetchsiswabelum',
                type: 'post',
                data: {
                    id_divisi: id_divisi
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    // console.log(data.siswa);
                    // let divisii = data.divisi
                    let i = "1";
                    tabelsiswa(data.siswa, data.divisi);
                }
            });
        }

        fetchSiswa();

        $("#searchkelas").change(function() {
            let kelas = $("#searchkelas").val();
            let id_divisi = $('#iddivisicek').attr('value');
            // $('#selectrombelsemua').attr('selected')
            // alert(divisiasal)
            // console.log(kelas);
            // console.log(id_divisi);

            if (kelas == 'semua') {

                $('#tableSiswa').DataTable().destroy();
                fetchSiswa();

            } else if (kelas == 'belum') {

                $('#tableSiswa').DataTable().clear();
                $('#tableSiswa').DataTable().destroy();
                fetchSiswaBelum();

            } else {
                // console.log(divisiasal)

                $('#tableSiswa').DataTable().clear();
                $('#tableSiswa').DataTable().destroy();
                $.ajax({
                    url: "<?= base_url(); ?>/tatausaha/fetchsiswakelas",
                    type: "post",
                    data: {
                        kelas: kelas,
                        id_divisi: id_divisi
                    },
                    async: true,
                    dataType: "json",

                    success: function(data) {
                        // console.log(data)
                        if (data.responce == 'success') {
                            // console.log(data.responce)
                            tabelsiswa(data.siswa, data.divisi)
                        } else {
                            // console.log(data.responce)
                            tabelsiswa(data.siswa, data.divisi)
                        }
                    }
                });


            }
        })

        $("#searchrombel").change(function() {
            let rombel = $("#searchrombel").val();
            let id_divisi = $('#iddivisicek').attr('value');
            // alert(divisiasal)
            console.log(rombel);
            // console.log(id_divisi);

            if (rombel == 'semua') {

                $('#tableSiswa').DataTable().destroy();
                fetchSiswa();

            } else if (rombel == 'belum') {

                $('#tableSiswa').DataTable().clear();
                $('#tableSiswa').DataTable().destroy();
                fetchSiswaBelum();

            } else {
                // console.log(divisiasal)

                $('#tableSiswa').DataTable().clear();
                $('#tableSiswa').DataTable().destroy();
                $.ajax({
                    url: "<?= base_url(); ?>/tatausaha/fetchsiswarombel",
                    type: "post",
                    data: {
                        rombel: rombel,
                        id_divisi: id_divisi
                    },
                    async: true,
                    dataType: "json",

                    success: function(data) {
                        console.log(data)
                        if (data.responce == 'success') {
                            // console.log(data.responce)
                            tabelsiswa(data.siswa, data.divisi)
                        } else {
                            // console.log(data.responce)
                            tabelsiswa(data.siswa, data.divisi)
                        }
                    }
                });


            }
        })

        // tambah siswa
        $("#tambahsiswaform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/tambahsiswa',
                type: 'post',
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // setting a timeout
                    $('#btnsavesiswa').attr('disabled');
                    $("#btnsavesiswa").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        // console.log(data.update);
                        $('#tableSiswa').DataTable().destroy();
                        fetchSiswa();
                        $('#siswaModal').modal('hide');
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                        // console.log(data);
                    }


                },
                complete: function() {
                    $('#btnsavesiswa').removeAttr('disabled');
                    $("#btnsavesiswa").html(`Simpan`);

                },
            });


        });

        $(document).on('click', '.passwordsiswa', function(e) {
            $("#editpasswordform")[0].reset();

            let arrayvalue = $(this).attr("value").split("/");

            let idsiswa = arrayvalue[0];
            let namasiswa = arrayvalue[1];

            $('#passwordModal').modal('show')
            $("input[name='idsiswapassword']").val(idsiswa);
            $("#namapassword").text(namasiswa);

        });

        // edit password
        $('#editpasswordform').submit(function() {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url('/tatausaha/editpasswordsiswa'); ?>',
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

        // modal edit
        $(document).on("click", ".editsiswa", function() {
            event.preventDefault();
            $("#editj_kel").children().remove();
            $("#editpendapatan_ayah").children().remove();
            $("#editpendapatan_ibu").children().remove();
            let idsiswa = $(this).attr("value")
            $.ajax({
                url: '<?= base_url('/tatausaha/editmodalsiswa'); ?>',
                type: 'post',
                data: {
                    idsiswa: idsiswa
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.responce == 'success') {
                        $('#editsiswaModal').modal('show');
                        $("input[name='idsiswa']").val(data.siswa.id);
                        $("input[name='username']").val(data.siswa.username);
                        $("input[name='nik']").val(data.siswa.nik);
                        $("input[name='nisn']").val(data.siswa.nisn);
                        $("input[name='nama_lengkap']").val(data.siswa.nama_lengkap);
                        $("input[name='panggilan']").val(data.siswa.panggilan);



                        $("#editj_kel").append('<option value="" ' + ((data.siswa.j_kel == '') ? 'selected="selected"' : '') + '>-- Pilih jenis Kelamin --</option>');
                        $("#editj_kel").append('<option value="laki-laki" ' + ((data.siswa.j_kel == 'laki-laki') ? 'selected="selected"' : '') + '>Laki-laki</option>');
                        $("#editj_kel").append('<option value="perempuan" ' + ((data.siswa.j_kel == 'perempuan') ? 'selected="selected"' : '') + '>Perempuan</option>');



                        $("input[name='tem_lahir']").val(data.siswa.tem_lahir);
                        $("input[name='tgl_lahir']").val(data.siswa.tgl_lahir);
                        $("input[name='tahun_lulus']").val(data.siswa.tahun_lulus);
                        $("input[name='lanjut_sekolah']").val(data.siswa.lanjut_sekolah);

                        // $("input[name='foto']").val(data.siswa.foto);

                        $("#labeleditfoto").text(data.siswa.foto)
                        $("#editfotolama").val(data.siswa.foto)
                        $("#editpreviewfoto").attr("src", "<?= base_url(); ?>/asset/images/siswa/" + data.siswa.foto);


                        $("input[name='ayah']").val(data.siswa.ayah);
                        $("input[name='pekerjaan_ayah']").val(data.siswa.pekerjaan_ayah);

                        // $("input[name='pendapatan_ayah']").val(data.siswa.pendapatan_ayah);
                        $("#editpendapatan_ayah").append('<option value="" ' + ((data.siswa.pendapatan_ayah == '') ? 'selected="selected"' : '') + '>-- Pilih Pendapatan --</option>');
                        $("#editpendapatan_ayah").append('<option value="tidak ada" ' + ((data.siswa.pendapatan_ayah == 'tidak ada') ? 'selected="selected"' : '') + '>Tidak Ada</option>');
                        $("#editpendapatan_ayah").append('<option value="< 5 Juta" ' + ((data.siswa.pendapatan_ayah == '< 5 Juta') ? 'selected="selected"' : '') + '>&lt 5 Juta</option>');
                        $("#editpendapatan_ayah").append('<option value="5-8 Juta" ' + ((data.siswa.pendapatan_ayah == '5-8 Juta') ? 'selected="selected"' : '') + '>5-8 Juta</option>');
                        $("#editpendapatan_ayah").append('<option value="8-15 Juta" ' + ((data.siswa.pendapatan_ayah == '8-15 Juta') ? 'selected="selected"' : '') + '>8-15 Juta</option>');
                        $("#editpendapatan_ayah").append('<option value="15-20 Juta" ' + ((data.siswa.pendapatan_ayah == '15-20 Juta') ? 'selected="selected"' : '') + '>15-20 Juta</option>');
                        $("#editpendapatan_ayah").append('<option value="20-30 Juta" ' + ((data.siswa.pendapatan_ayah == '20-30 Juta') ? 'selected="selected"' : '') + '>20-30 Juta</option>');
                        $("#editpendapatan_ayah").append('<option value="> 30 Juta" ' + ((data.siswa.pendapatan_ayah == '> 30 Juta') ? 'selected="selected"' : '') + '>&gt 30 Juta</option>');

                        $("input[name='ibu']").val(data.siswa.ibu);
                        $("input[name='pekerjaan_ibu']").val(data.siswa.pekerjaan_ibu);

                        // $("input[name='pendapatan_ibu']").val(data.siswa.pendapatan_ibu);
                        $("#editpendapatan_ibu").append('<option value="" ' + ((data.siswa.pendapatan_ibu == '') ? 'selected="selected"' : '') + '>-- Pilih Pendapatan --</option>');
                        $("#editpendapatan_ibu").append('<option value="tidak ada" ' + ((data.siswa.pendapatan_ibu == 'tidak ada') ? 'selected="selected"' : '') + '>Tidak Ada</option>');
                        $("#editpendapatan_ibu").append('<option value="< 5 Juta" ' + ((data.siswa.pendapatan_ibu == '< 5 Juta') ? 'selected="selected"' : '') + '>&lt 5 Juta</option>');
                        $("#editpendapatan_ibu").append('<option value="5-8 Juta" ' + ((data.siswa.pendapatan_ibu == '5-8 Juta') ? 'selected="selected"' : '') + '>5-8 Juta</option>');
                        $("#editpendapatan_ibu").append('<option value="8-15 Juta" ' + ((data.siswa.pendapatan_ibu == '8-15 Juta') ? 'selected="selected"' : '') + '>8-15 Juta</option>');
                        $("#editpendapatan_ibu").append('<option value="15-20 Juta" ' + ((data.siswa.pendapatan_ibu == '15-20 Juta') ? 'selected="selected"' : '') + '>15-20 Juta</option>');
                        $("#editpendapatan_ibu").append('<option value="20-30 Juta" ' + ((data.siswa.pendapatan_ibu == '20-30 Juta') ? 'selected="selected"' : '') + '>20-30 Juta</option>');
                        $("#editpendapatan_ibu").append('<option value="> 30 Juta" ' + ((data.siswa.pendapatan_ibu == '> 30 Juta') ? 'selected="selected"' : '') + '>&gt 30 Juta</option>');

                        // $("input[name='alamat']").val(data.siswa.alamat);
                        $("#editalamat").text(data.siswa.alamat)
                        $("input[name='no_hp']").val(data.siswa.no_hp);

                    } else {

                        toastr["error"](data.pesan);
                    }

                }
            });
        });

        // Edit siswa
        $("#editsiswaform").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>/tatausaha/editsiswa',
                type: 'post',
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // setting a timeout
                    $('#editbtnsavesiswa').attr('disabled');
                    $("#editbtnsavesiswa").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        // console.log(data.update);
                        $('#tableSiswa').DataTable().destroy();
                        fetchSiswa();
                        $('#editsiswaModal').modal('hide');
                        toastr["success"](data.pesan);
                    } else {
                        toastr["error"](data.pesan);
                        // console.log(data);
                    }


                },
                complete: function() {
                    $('#editbtnsavesiswa').removeAttr('disabled');
                    $("#editbtnsavesiswa").html(`Update`);

                },
            });


        });

        // import siswa
        $('#importsiswa').submit(function() {
            event.preventDefault();
            $.ajax({
                url: '<?= base_url('/tatausaha/importsiswa'); ?>',
                type: 'post',
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // setting a timeout
                    $('#btnimportsiswa').attr('disabled');
                    $("#btnimportsiswa").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                },
                success: function(data) {
                    if (data.responce == "success") {
                        console.log(data.cekuser)
                        console.log(data.ceknik)
                        $('#tableSiswa').DataTable().destroy();
                        fetchSiswa();
                        $('#importModal').modal('hide');
                        // toastr["success"](data.pesan);
                        Swal.fire(
                            'Import Selesai',
                            'Terdapat ' + data.angkasukses + ' data sukses diimport dan ' + data.angkagagal + ' data gagal diimport',
                            'success'
                        )
                    } else {
                        // console.log(data);
                        toastr["error"](data.pesan);
                    }
                },
                complete: function() {
                    $('#btnimportsiswa').removeAttr('disabled');
                    $("#btnimportsiswa").html(`Update`);

                },
            });

        });

        // Check all 
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.delete_checkbox').prop('checked', true);
            } else {
                $('.delete_checkbox').prop('checked', false);
            }
        });

        $('.delete_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });

        $('#deletesiswa').click(function() {

            var checkbox = $('.delete_checkbox:checked');

            if (checkbox.length > 0) {
                Swal.fire({
                    title: 'Apa kamu yakin ingin menghapus ' + checkbox.length + ' data siswa?',
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
                            url: '<?= base_url('/tatausaha/deletesiswa'); ?>',
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
                                        'Data berhasil dihapus.',
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

        $("#uploadfotosiswa").submit(function(event) {
            event.preventDefault();
            // console.log($("input[name='nik']").val())

            Swal.fire({
                title: 'Apa kamu yakin Nama filenya sudah sesuai?',
                text: "gambar akan tersinkron otomatis dengan nama filenya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Benar!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url(); ?>/tatausaha/uploadfotosiswa',
                        type: 'post',
                        // data: $(this).serialize(),
                        data: new FormData(this),
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {

                            // setting a timeout
                            $('#btnuploadfotosiswa').attr('disabled');
                            $("#btnuploadfotosiswa").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);


                        },
                        success: function(data) {
                            if (data.responce == "success") {
                                $('#uploadModal').modal('hide');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Selamat !! Upload foto telah berhasil',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                // window.location.reload();
                            } else {
                                toastr["error"](data.pesan);
                                // console.log(data);
                            }
                        },
                        complete: function(data) {
                            $('#btnuploadfotosiswa').removeAttr('disabled');
                            $("#btnuploadfotosiswa").html(`Upload`);

                            if (data.responce == 'success') {
                                $('#uploadfotosiswa')[0].reset();
                            }
                        },
                    });

                }
            })

        });

    });
</script>

<?= $this->endSection(); ?>