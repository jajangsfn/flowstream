<body>
<center><h2>Neraca Saldo</h2></center>
<center><h4>Periode : <?=$periode?></h4></center>
<div class="row">
<div class="col-9"></div>
<div class="col-3">
<table class="table table-bordered">
<tbody>
<tr>
<td><label>Hal</label></td>
<td>:</td>
<td>1 dari 1</td>
</tr>
<tr>
<td><label>Tanggal</label></td>
<td>:</td>
<td><?=date('d/m/Y')?></td>
</tr>
<tr>
<td><label>Waktu</label></td>
<td>:</td>
<td><?=date('H:i:s')?></td>
</tr>
</tbody>
</table>
</div>
</div>
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
                                $position    = (is_null($row->position) || $row->position == 'D') ? 'D' : 'K';
                                $saldo_akhir = $position == 'D' ? 
                                                ($row->saldo_bln_lalu + $row->total_debit - $row->total_credit)
                                                :($row->saldo_bln_lalu + $row->total_credit - $row->total_debit);
                                ?>
                                <tr>
                                    <td class="text-center"><?=$key+1?></td>
                                    <td><?=$row->acc_code?></td>
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
                </table>
  </body>

<script type="text/javascript">
  window.onload = function(){
  window.print();
};
</script>