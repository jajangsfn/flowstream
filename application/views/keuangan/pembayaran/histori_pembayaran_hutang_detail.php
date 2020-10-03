<?php if (count($histori_pembayaran_hutang) > 0) : ?>
    <div class="card gutter-b">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Nomor Purchase Order</th>
                            <th>Tagihan</th>
                            <th>Terbayar</th>
                            <th>Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($histori_pembayaran_hutang as $index_transaksi => $entry_transaksi) : ?>
                            <tr>
                                <td colspan="4">
                                    #<?= $entry_transaksi->invoice_no ?>
                                </td>
                            </tr>
                            <?php foreach ($entry_transaksi->details as $index => $entry_pembayaran) : ?>
                                <tr>
                                    <td class="text-right font-weight-bold">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td>
                                        <?= number_format($entry_pembayaran->total_bill, 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?= number_format($entry_pembayaran->payment, 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?= $entry_pembayaran->payment_date ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="card">
        <div class="card-body text-center">
            <h5 class="text-success">
                Belum Terdapat Histori Pembayaran Hutang
            </h5>
        </div>
    </div>
<?php endif ?>