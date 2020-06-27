<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                <?= $this->lang->line("general_list_goods"); ?>
            </h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambahMasterBarangModal">
                <i class="la la-plus"></i><?= $this->lang->line("general_add"); ?>
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="master_barang_table">
            <thead>
                <tr>
                    <th><?= $this->lang->line("general_number"); ?></th>
                    <th><?= $this->lang->line("general_name"); ?></th>
                    <th><?= $this->lang->line("general_barcode"); ?></th>
                    <th><?= $this->lang->line("general_sku"); ?></th>
                    <th><?= $this->lang->line("general_plu"); ?></th>
                    <th><?= $this->lang->line("general_division"); ?></th>
                    <th><?= $this->lang->line("general_subdivision"); ?></th>
                    <th><?= $this->lang->line("general_category"); ?></th>
                    <th><?= $this->lang->line("general_subcategory"); ?></th>
                    <th><?= $this->lang->line("general_package"); ?></th>
                    <th><?= $this->lang->line("general_color"); ?></th>
                    <th><?= $this->lang->line("general_unit"); ?></th>
                    <th><?= $this->lang->line("general_hpp"); ?></th>
                    <th><?= $this->lang->line("general_quantity"); ?></th>
                    <th><?= $this->lang->line("general_tax"); ?></th>
                    <th><?= $this->lang->line("general_action"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($list_barang); $i++) {
                    $barang = $list_barang[$i]; ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td nowrap="nowrap"><?= $barang->name ?></td>
                        <td><?= $barang->barcode ?></td>
                        <td><?= $barang->sku_code ?></td>
                        <td><?= $barang->plu_code ?></td>
                        <td><?= $barang->division ?></td>
                        <td><?= $barang->sub_division ?></td>
                        <td><?= $barang->category ?></td>
                        <td><?= $barang->sub_category ?></td>
                        <td><?= $barang->package ?></td>
                        <td><?= $barang->color ?></td>
                        <td><?= $barang->unit ?></td>
                        <td><?= $barang->hpp ?></td>
                        <td><?= $barang->quantity ?></td>
                        <td><?= $barang->tax ?></td>
                        <td nowrap="nowrap">
                            <button type="button" class="btn btn-icon btn-sm btn-light-warning" data-toggle="modal" data-target="#edit_harga_<?= $barang->id ?>">
                                <i class="fa la-money-bill"></i>
                            </button>
                            <?= $this->load->view("component/icon_button/edit", array("id" => $barang->id), true); ?>
                            <?= $this->load->view("component/icon_button/delete", array("id" => $barang->id), true); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<!-- Modal-->
<?= $this->load->view("component/modal/barang/tambah_barang", '', true); ?>


<?= $this->load->view("component/modal/barang/ubah_hapus_barang", '', true); ?>