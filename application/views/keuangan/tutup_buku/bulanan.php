<div class="card gutter-b">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <select class="select2 py-5" id="bulan" data-width="100%">
                    <option label="" value="" selected disabled>Pilih Periode</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="select2 py-5" id="tahun" data-width="100%">
                    <option label="" value="" selected disabled>Pilih Tahun</option>
                    <?php for ($i = $earliest_year; $i <= date("Y"); $i++) : ?>
                        <option value="<?= $i ?>" <?= $earliest_year == date("Y") ? "selected" : "" ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="w-100 text-center">
            <button type="button" class="btn btn-primary" onclick="check_periode()">
                Cek Tutup Buku
            </button>
        </div>
    </div>
</div>

<div style="display: none;" class="card gutter-b" id="neraca_saldo_cell">
    <div class="card-body">
        <h4 class="font-weight-bold">
            Neraca Saldo
        </h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Saldo Periode Sebelumnya</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo Akhir</th>
                    </tr>
                </thead>
                <tbody id="neraca_saldo_list">

                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="display: none;" class="card gutter-b" id="ikhtisar_saldo_cell">
    <div class="card-body">
        <h4 class="font-weight-bold">
            Ikhtisar Saldo
        </h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Saldo Periode Sebelumnya</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo Akhir</th>
                    </tr>
                </thead>
                <tbody id="ikhtisar_saldo_list">

                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="display: none;" class="card gutter-b" id="kode_rekening_saldo_cell">
    <div class="card-body">
        <h4 class="font-weight-bold">
            Saldo Kode Rekening
        </h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Saldo Periode Sebelumnya</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo Akhir</th>
                    </tr>
                </thead>
                <tbody id="kode_rekening_saldo_list">

                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="display: none;" class="card gutter-b" id="konfirmasi_cell">
    <div class="card-body text-center">
        <a class="btn btn-primary" id="konfirmasi_button">
            Konfirmasi Tutup Buku
        </a>
    </div>
</div>