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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($histori_pembayaran_piutang as $entry_partner) : ?>
                            <tr>
                                <td colspan="2">
                                    <?= $entry_partner->partner_name ?>
                                </td>
                                <td class="text-primary lead font-weight-bold">
                                    <?php $sum = 0 ?>
                                    <?php foreach ($entry_partner->details as $index => $entry_pembayaran) : ?>
                                        <?php $sum += intval($entry_pembayaran->total_bill) ?>
                                    <?php endforeach; ?>
                                    <?= number_format($sum, 0, ',', '.') ?>
                                </td>
                            </tr>
                            <?php foreach ($entry_partner->details as $index => $entry_pembayaran) : ?>
                                <tr>
                                    <td class="text-right font-weight-bold">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url("/index.php/penjualan/pos/view/") ?><?= $entry_pembayaran->pos_id ?>">
                                            #<?= $entry_pembayaran->invoice_no ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= number_format($entry_pembayaran->total_bill, 0, ',', '.') ?>
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
                Belum Terdapat Piutang
            </h5>
        </div>
    </div>
<?php endif ?>