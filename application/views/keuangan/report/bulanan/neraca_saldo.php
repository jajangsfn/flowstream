<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="card-body" method="get" action="<?=base_url()?>index.php/keuangan/report/bulanan/neraca_saldo">
                <table class="table table-condensed col-4">
                    <tbody>
                        <tr>
                            <td width="50">Periode</td>
                            <td width="1">:</td>
                            <td width="100">
                                <select name="periode" class="form-control select2 col-9" required>
                                    <option value="">Pilih Periode</option>
                                    <?php
                                    for($i = 1; $i <= 12; $i++) { 
                                        $i = $i < 10 ? "0".$i: $i;
                                        ?>
                                        <option value="<?=$i?>" <?=isset($_GET['periode']) && $_GET['periode'] == $i ? 'selected': ''?>><?=$i?></option>
                                    <?php }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td width="50">Tahun</td>
                            <td width="1">:</td>
                            <td width="50">
                                <select name="year" class="form-control select2 col-7" required>
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                    for($i = date('Y'); $i >= 2015; $i--) { 
                                        ?>
                                        <option value="<?=$i?>" <?=isset($_GET['year']) && $_GET['year'] == $i ? 'selected': ''?>><?=$i?></option>
                                    <?php }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-center">
                                <button type="submit" name="submit" class="btn btn-success btn-block">
                                Cari
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-condensed table-striped dataTable">
                    <thead class="text-center">
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Rekening</th>
                        <th colspan="2">Saldo bulan lalu</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th colspan="2">Saldo bulan ini</th>
                    </thead>
                    <tbody>
                    
                      <?php
                        if (count($neraca)) {
                            foreach($neraca as $key => $row) { 
                                $acc_code    = str_replace(".","",
                                                            substr( 
                                                                    str_replace("-","",$row->acc_code)
                                                                    , 3
                                                                )
                                                          );
                                $position    = (is_null($row->position) || $row->position == 'D') ? 'D' : 'K';
                                $saldo_akhir = $position == 'D' ? 
                                                ($row->saldo_bln_lalu + $row->total_debit - $row->total_credit)
                                                :($row->saldo_bln_lalu + $row->total_credit - $row->total_debit);
                                ?>
                                <tr>
                                    <td class="text-center"><?=$key+1?></td>
                                    <td><?=$acc_code?></td>
                                    <td><?=$row->acc_name?></td>
                                    <td class="text-right"><?=number_format($row->saldo_bln_lalu)?></td>
                                    <td><?=$position?></td>
                                    <td class="text-right"><?=number_format($row->total_debit)?></td>
                                    <td class="text-right"><?=number_format($row->total_credit)?></td>
                                    <td class="text-right"><?=number_format($saldo_akhir)?></td>
                                    <td><?=$position?></td>
                                </tr>

                           <?php }
                        }
                      ?>
                    </tbody>
                    <tfoot>
                    <?php
                    if (count($neraca)) {
                    ?>
                        <tr>
                            <td colspan="9" class="text-right">
                                <a href="<?=base_url()?>index.php/Keuangan/print_neraca_saldo/<?=$_GET['year']."-".$_GET['periode']?>" target="_blank" class="btn btn-success">
                                    Cetak
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>