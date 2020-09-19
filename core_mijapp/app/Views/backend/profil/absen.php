<?= $this->extend('backend/layout/template_admin'); ?>

<?= $this->section('content'); ?>

<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 float-right">
                <div class="form-group row">
                    <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="searchbulan" name="searchbulan">
                    </div>
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="searchtahun" name="searchtahun">
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped" id="tableAbsen">
                        <thead class="bg-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Bulan</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Sakit</th>
                                <th scope="col">Izin</th>
                                <th scope="col">Alpha</th>
                                <th scope="col">Cuti</th>
                                <th scope="col">Lainnya</th>
                                <th scope="col">Hadir</th>
                                <th scope="col">User Update</th>
                            </tr>
                        </thead>

                    </table>
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

        function tabelabsen(dataks) {
            $('#tableAbsen').DataTable({
                "data": dataks,
                "responsive": true,
                "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "buttons": [
                    'copy', 'excel', 'pdf'
                ],

                "columns": [{
                        "data": null,
                        "render": function() {
                            let i = 1;

                            return a = i++;
                        }
                    },

                    {
                        "data": "nip"
                    },
                    {
                        "data": "nama_lengkap"
                    },
                    {
                        "data": 'bulan',
                    },
                    {
                        "data": 'tahun',
                    },
                    {
                        "data": 'sakit',
                    },
                    {
                        "data": 'izin',
                    },
                    {
                        "data": 'alpha',
                    },
                    {
                        "data": 'cuti',
                    },
                    {
                        "data": 'lain',
                    },
                    {
                        "data": 'hadir',
                    },
                    {
                        "data": 'user_update',
                    }

                ]
            });
        }

        //fetch Absen
        function fetchAbsen() {
            $.ajax({
                url: '<?= base_url(); ?>/profil/fetchabsen',
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    // let i = "1";
                    tabelabsen(data.absen);
                }
            });
        }

        fetchAbsen();

        // #column3_search is a <input type="text"> element
        $('#searchbulan').on('keyup', function() {
            $('#tableAbsen').DataTable()
                .columns(3)
                .search(this.value)
                .draw();
        });

        $('#searchtahun').on('keyup', function() {
            $('#tableAbsen').DataTable()
                .columns(4)
                .search(this.value)
                .draw();
        });


    });
</script>

<?= $this->endSection(); ?>