<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<script>
    /**
     * Get Destination Data From Class Group Settings
     */
    function getFromTargetList() {
        $('.destination-class-overlay').show();


        $('.destination-class-overlay').hide();
    }
</script>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- <div class="row">
            <div class="callout callout-primary">
                <h4>Petunjuk Singkat</h4>
                <ul>
                    <li>Untuk mengatur rombongan belajar, silahkan pilih <strong>KELAS ASAL</strong> pada tabel sebelah kiri.</li>
                    <li>Peserta Didik yang ditampilkan hanya peserta didik dengan status <strong>"Aktif"</strong></li>
                    <li>Jika kelas asal yang dipilih yaitu <strong>"BELUM DIATUR"</strong> maka akan menampilkan semua peserta didik yang belum pernah diatur kelasnya. Biasanya digunakan untuk menampilkan peserta didik baru.</li>
                    <li>Jika yang dipilih <strong>"TAMPILKAN SEMUA"</strong>, maka akan menampilkan semua peserta didik yang aktif, termasuk peserta didik baru yang belum pernah diatur kelasnya.</li>
                    <li>Jika yang dipilih <strong>"NAMA KELASNYA"</strong>, maka akan diminta untuk memilih <strong>"Tahun"</strong></li>
                    <li>Setelah data peserta didik tampil, silahkan <strong>"CEKLIS"</strong> peserta didik yang akan diatur kelasnya</li>
                    <li>Setelah selesai memilih peserta didik yang akan dipindah kelasnya, silahkan pilih <strong>"KELAS TUJUAN"</strong> dan <strong>"Tahun"</strong> pada tabel sebelah kanan.</li>
                    <li>Terakhir klik tombol <strong>"PINDAH KE KELAS TUJUAN"</strong></li>
                    <li>Jika terjadi kelasahan penginputan data, silahkan pilih <strong>"KELAS TUJUAN"</strong> dan <strong>"Tahun"</strong> pada tabel sebelah kanan, kemudian ceklis peserta didik yang akan dihapus dari kelas tersebut dan terakhir klik tombol <strong>"HAPUS"</strong></li>
                </ul>
            </div>
        </div> -->

        <div class="row">

            <div class="col-md-12">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <form action="">
                            <div class="form-group row">
                                <label for="divisiasal" class="col-sm-4 col-form-label">Divisi Asal</label>
                                <div class="col-sm-8">
                                    <select name="divisiasal" id="divisiasal" class="form-control">
                                        <option value="semua" selected>Tampilkan semua</option>
                                        <option value="belum">Belum Diatur</option>
                                        <?php foreach ($divisi as $divisi) : ?>
                                            <option value="<?= $divisi['divisi']; ?>"><?= $divisi['divisi']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <form action="">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Divisi Tujuan</label>
                                <div class="col-sm-8">
                                    <select name="divisitujuan" id="divisitujuan" class="form-control">
                                        <option selected disabled>Tampilkan semua</option>
                                        <?php foreach ($divisi2 as $div) : ?>
                                            <option value="<?= $div['divisi']; ?>"><?= $div['divisi']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-sm btn-primary" id="btntujuandivisipegawai"><i class="fa fa-arrow-right"></i> Tambah Divisi Tujuan</button>
                    </div>


                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed" id="tableAsalPegawai">
                                <thead class="bg-navy">
                                    <tr>
                                        <th><input type="checkbox" id='checkall'></th>
                                        <!-- <th scope="col">No</th> -->
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Divisi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="overlay asal-divisi-overlay" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>

            </div>
        </div>



    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function() {

        function tabelpegawai(dataks) {
            $('#tableAsalPegawai').DataTable({
                "data": dataks,
                "responsive": true,
                "dom": "<'row'<'col-sm-12 col-md-7'l><'col-sm-12 col-md-4'f><'col-sm-12 col-md-1'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="far fa-fw fa-file-excel"></i>',
                    titleAttr: 'Excel'
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
                                '<input type="checkbox" name="checkbox" id = "' + row.id + '"  value = "' + row.id + '" class="select_checkbox"></input>';

                            return r;
                        },
                    },

                    {
                        "data": "nip"
                    },
                    {
                        "data": "nama_lengkap"
                    },
                    {

                        "data": 'divisi',

                        "render": function(data, type, row, meta) {


                            let a = '';
                            if (data == null) {
                                a = ''
                            } else {
                                let explode = data.split(",");

                                for (let i = 0; i < explode.length; i++) {
                                    a += `<span class="badge badge-info mr-1">` + explode[i] + `</span>`
                                };
                                // a = `<span class="badge badge-info">` + data + `</span>`
                            }
                            return a
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            let a = '';
                            if (row.id == null) {
                                a = ``;
                            } else {
                                a = `
                                    <a href="" value="${row.id}" class="badge badge-danger deletedivisipegawai"><i class="fas fa-fw fa-trash-alt"></i></a>`
                            }

                            return a;
                        }
                    },
                ]
            });
        }

        //fetch Divisi asal belum diatur
        function fetchDivisiAsalbd() {
            $.ajax({
                url: '<?= base_url(); ?>/pegawai/fetchdivisibdpegawai',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data.pegawai);
                    let i = "1";
                    // let role_kode_hidden = $("input[name='role_kode_hidden']").attr("value");;
                    tabelpegawai(data.pegawai)
                }
            });
        }

        //fetch Divisi asal semua
        function fetchDivisiAsalSemua() {
            $.ajax({
                url: '<?= base_url(); ?>/pegawai/fetchdivisisemuapegawai',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data.pegawai);
                    let i = "1";
                    tabelpegawai(data.pegawai)
                }
            });
        }

        fetchDivisiAsalSemua();


        // delete divisi
        $(document).on("click", ".deletedivisipegawai", function() {
            event.preventDefault();
            let iddivisipegawai = $(this).attr('value');
            // alert(iddivisipegawai)
            Swal.fire({
                title: 'Apa kamu yakin untuk menghapusnya?',
                text: "kamu tidak akan bisa mengembalikannya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('/pegawai/deletedivisipegawai'); ?>/' + iddivisipegawai,
                        type: 'DELETE',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $('#tableAsalPegawai').DataTable().destroy();
                            fetchDivisiAsalSemua();
                            Swal.fire(
                                'Deleted!',
                                'File sudah terdelete.',
                                'success'
                            )
                        }
                    });

                }
            })
        });

        $("#divisiasal").change(function() {
            let divisiasal = $("#divisiasal").val();
            // alert(divisiasal)
            if (divisiasal == 'semua') {
                $('.asal-divisi-overlay').show();
                $('#tableAsalPegawai').DataTable().destroy();
                fetchDivisiAsalSemua();
                $('.asal-divisi-overlay').hide();
            } else if (divisiasal == 'belum') {
                $('.asal-divisi-overlay').show();
                $('#tableAsalPegawai').DataTable().clear();
                $('#tableAsalPegawai').DataTable().destroy();
                fetchDivisiAsalbd();
                $('.asal-divisi-overlay').hide();
            } else {
                // console.log(divisiasal)
                $('.asal-divisi-overlay').show();
                $('#tableAsalPegawai').DataTable().clear();
                $('#tableAsalPegawai').DataTable().destroy();
                $.ajax({
                    url: "<?= base_url(); ?>/pegawai/fetchdivisipegawai",
                    type: "post",
                    data: {
                        divisiasal: divisiasal
                    },
                    async: true,
                    dataType: "json",

                    success: function(data) {
                        // console.log(data.satuan)
                        if (data.responce == 'success') {
                            // console.log(data.responce)
                            tabelpegawai(data.pegawai)
                        } else {
                            // console.log(data.responce)
                            tabelpegawai(data.pegawai)
                        }
                    }
                });


                $('.asal-divisi-overlay').hide();
            }
        })

        // Check all 
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.select_checkbox').prop('checked', true);
            } else {
                $('.select_checkbox').prop('checked', false);
            }
        });

        $('.select_checkbox').click(function() {
            if ($(this).is(':checked')) {
                $(this).closest('tr').addClass('removeRow');
            } else {
                $(this).closest('tr').removeClass('removeRow');
            }
        });



        $('#btntujuandivisipegawai').click(function() {
            let checkbox = $('.select_checkbox:checked');
            let iddivisitujuan = $("#divisitujuan").val();
            // let iddivisitujuan = $("input[name='divisitujuan']").val();;

            // alert(iddivisitujuan);

            if (iddivisitujuan == null) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih divisi tujuan dulu ya',
                })
            } else {
                if (checkbox.length > 0) {
                    Swal.fire({
                        title: 'Apa kamu yakin ingin menambah ' + checkbox.length + ' data divisi pegawai?',
                        text: "kamu bisa menghapusnya kembali nanti!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, tambahkan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let checkbox_value = [];
                            $(checkbox).each(function() {
                                checkbox_value.push($(this).val());
                            });

                            // console.log(checkbox);
                            $.ajax({
                                url: '<?= base_url('/pegawai/btntujuandivisipegawai'); ?>',
                                type: "POST",
                                data: {
                                    checkbox_value: checkbox_value,
                                    iddivisitujuan: iddivisitujuan
                                },
                                dataType: 'json',
                                beforeSend: function() {
                                    // setting a timeout
                                    $('#btntujuandivisipegawai').attr('disabled');
                                    $("#btntujuandivisipegawai").html(`<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>`);

                                },
                                success: function(data) {
                                    if (data.responce == "success") {
                                        console.log(data)
                                        Swal.fire(
                                            'Sukses!',
                                            'Data divisi berhasil ditambah.',
                                            'success'
                                        )
                                        $('#tableAsalPegawai').DataTable().destroy();
                                        fetchDivisiAsalSemua();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Ada yang tidak beres!',
                                        })
                                    }
                                },
                                complete: function() {
                                    $('#btntujuandivisipegawai').removeAttr('disabled');
                                    $("#btntujuandivisipegawai").html(`<i class="fa fa-arrow-right"></i> Tambah Divisi Tujuan`);

                                },
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
            }

        });


    })
</script>

<?= $this->endSection(); ?>