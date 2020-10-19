<?php if (count($histori_pembayaran_piutang) > 0) : ?>
    <div class="card gutter-b">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Nomor Invoice</th>
                            <th>Tagihan</th>
                            <th>Terbayar</th>
                            <th>Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($histori_pembayaran_piutang as $index_customer => $entry_customer) : ?>
                            <tr style="border-top: 2px solid grey">
                                <td colspan="5">
                                    <?= $entry_customer->customer_name ?>
                                </td>
                            </tr>
                            <?php foreach ($entry_customer->details as $index_transaksi => $entry_transaksi) : ?>
                                <tr>
                                    <td></td>
                                    <td colspan="4">
                                        <a href="<?= base_url("/index.php/penjualan/pos/view/") ?><?= $entry_transaksi->pos_id ?>">
                                            #<?= $entry_transaksi->invoice_no ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php foreach ($entry_transaksi->details as $index => $entry_pembayaran) : ?>
                                    <tr>
                                        <td class="text-right font-weight-bold" colspan="2">
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
                Belum Terdapat Histori Pembayaran Piutang
            </h5>
        </div>
    </div>
<?php endif ?>