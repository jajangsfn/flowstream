<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="card-body" method="get" action="<?=base_url()?>index.php/keuangan/report/ikhtisar/buku_besar">
                <table class="table table-condensed col-4">
                    <tbody>
                        <tr>
                            <td width="50">Periode</td>
                            <td width="1">:</td>
                            <td>
                                <select name="periode" class="form-control select2" required>
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
                            <td>
                                <select name="year" class="form-control select2" required>
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
                <table class="table table-bordered table-condensed dataTable">
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
                        $total_saldo_debit = 0;
                        $total_saldo_credit= 0;
                        $total_saldo_bulan_lalu = 0;
                        $total_saldo_bulan_lalu_d = 0;
                        $total_saldo_bulan_lalu_c = 0;
                        $total_saldo_bulan_ini = 0;
                        $total_saldo_bulan_ini_d = 0;
                        $total_saldo_bulan_ini_c = 0;

                        if (count($ikhtisar_buku_besar)) {
                            $i = 1;
                            foreach($ikhtisar_buku_besar as $key => $value) { 
                                ?>
                                    <tr class="bg-light-success">
                                        <td colspan='7'><?=$value['acc_code_header']?> <?=$value['acc_name_header']?></td>
                                    </tr>
                                <?
                                foreach($value['data'] as $key2 => $row) {                                
                                        $position    = $row['position'];
                                        $saldo_akhir = $position == 'D' ? 
                                                                    ($row['saldo_bln_lalu'] + $row['total_debit'] - $row['total_credit'])
                                                                    :($row['saldo_bln_lalu'] + $row['total_credit'] - $row['total_debit']);
                                        $total_saldo_debit+= $row['total_debit'];
                                        $total_saldo_credit+= $row['total_credit'];
                                        
                                        //saldo bulan lalu
                                        $total_saldo_bulan_lalu+= $row['saldo_bln_lalu'];
                                        //jika posisinya debit maka jumlahkan saldo bulan lalu bertipe debit
                                        //jika posisinya credit maka jumlahkan saldo bulan lalu bertipe credit
                                        $total_saldo_bulan_lalu_d+= $position == 'D' ? $row['saldo_bln_lalu'] : 0;
                                        $total_saldo_bulan_lalu_c+= $position == 'K' ? $row['saldo_bln_lalu'] : 0;
                                        
                                        //saldo bulan ini
                                        $total_saldo_bulan_ini+=$saldo_akhir;
                                        //jika posisinya debit maka jumlahkan saldo bulan ini bertipe debit
                                        //jika posisinya credit maka jumlahkan saldo bulan ini bertipe credit
                                        $total_saldo_bulan_ini_d+= $position == 'D' ? $saldo_akhir : 0;
                                        $total_saldo_bulan_ini_c+= $position == 'K' ? $saldo_akhir : 0;

                                        $grant_total = $total_saldo_bulan_ini;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$i?></td>
                                            <td><?=$row['acc_code']?></td>
                                            <td><?=$row['acc_name']?></td>
                                            <td class="text-right"><?=number_format($row['saldo_bln_lalu']). " ".$position;?></td>
                                            <td class="text-right"><?=number_format($row['total_debit'])?></td>
                                            <td class="text-right"><?=number_format($row['total_credit'])?></td>
                                            <td class="text-right"><?=number_format($saldo_akhir)." ".$position;?></td>
                                        </tr>
                           <?php 
                                $i++;    
                                }
                            }
                        }
                      ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-light">
                            <td colspan="3" rowspan="2" class="font-weight-bold text-right text-middle">Jumlah</td>
                            <td class="font-weight-bold text-right"><?=number_format($total_saldo_bulan_lalu_d). " D";?></td>
                            <td class="font-weight-bold text-right" rowspan="2"><?=number_format($total_saldo_debit)?></td>
                            <td class="font-weight-bold text-right" rowspan="2"><?=number_format($total_saldo_credit)?></td>
                            <td class="font-weight-bold text-right"><?=number_format($total_saldo_bulan_ini_d)." D";?></td>
                        </tr>
                        <tr class="bg-light">
                            <td class="font-weight-bold text-right"><?=number_format($total_saldo_bulan_lalu_c)." K";?></td>
                            <td class="font-weight-bold text-right"><?=number_format($total_saldo_bulan_ini_c)." K";?></td>
                        </tr>


                    <?php
                    if (count($ikhtisar_buku_besar)) {
                    ?>
                        <tr>
                            <td colspan="9" class="text-right">
                                <a href="<?=base_url()?>index.php/Keuangan/print_ikhtisar_buku_besar/<?=$_GET['year']."-".$_GET['periode']?>" target="_blank" class="btn btn-success">
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