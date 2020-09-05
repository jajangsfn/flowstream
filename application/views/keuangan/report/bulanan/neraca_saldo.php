<div class="row">
    <div class="col-4">
        <div class="card">
            <form class="card-body" method="get" action="<?=base_url()?>index.php/keuangan/report/bulanan/neraca_saldo">
                <table class="table table-condensed">
                    <tr>
                        <td width="50">Periode</td>
                        <td width="1">:</td>
                        <td width="100"><select name="periode" class="form-control select2" required>
                                <option value="">Pilih Periode</option>
                                <?php
                                for($i = 1; $i <= 12; $i++) { 
                                    $i = $i < 10 ? "0".$i: $i;
                                    ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td width="50">Tahun</td>
                        <td width="1">:</td>
                        <td width="100"><select name="year" class="form-control select2" required>
                                <option value="">Pilih Tahun</option>
                                <?php
                                for($i = date('Y'); $i >= 2015; $i--) { 
                                    ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">
                            <button type="submit" name="submit" class="btn btn-success btn-block">
                            Cari
                            </button>
                        </td>
                </table>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-condensed">
                    <thead class="text-center">
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Rekening</th>
                        <th>Saldo bulan lalu</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Saldo bulan ini</th>
                    </thead>
                    <tbody>
                    
                      <?php
                        if (count($neraca)) {
                            foreach($neraca as $key => $row) { 
                                $saldo_akhir = $row->saldo_bln_lalu + $row->total_debit - $row->total_credit;
                                ?>
                                <tr>
                                    <td class="text-center"><?=$key+1?></td>
                                    <td><?=$row->acc_code?>
                                    <td><?=$row->acc_name?>
                                    <td class="text-right"><?=number_format($row->saldo_bln_lalu)?>
                                    <td class="text-right"><?=number_format($row->total_debit)?>
                                    <td class="text-right"><?=number_format($row->total_credit)?>
                                    <td class="text-right"><?=number_format($saldo_akhir)?>
                                </tr>

                           <?php }
                        }
                      ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>