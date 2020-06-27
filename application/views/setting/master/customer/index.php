<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Customer</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_partner">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_partner_table">
            <thead>
                <tr>
                    <th><?= $this->lang->line("general_number") ?></th>
                    <th><?= $this->lang->line("general_name") ?></th>
                    <th><?= $this->lang->line("general_master") ?></th>
                    <th><?= $this->lang->line("general_branch") ?></th>
                    <th><?= $this->lang->line("general_partner_code") ?></th>
                    <th><?= $this->lang->line("general_address_1") ?></th>
                    <th><?= $this->lang->line("general_address_2") ?></th>
                    <th><?= $this->lang->line("general_city") ?></th>
                    <th><?= $this->lang->line("general_province") ?></th>
                    <th><?= $this->lang->line("general_zip_code") ?></th>
                    <th><?= $this->lang->line("general_phone") ?></th>
                    <th><?= $this->lang->line("general_fax") ?></th>
                    <th>Email</th>
                    <th><?= $this->lang->line("general_tax_number") ?></th>
                    <th><?= $this->lang->line("general_salesman") ?></th>
                    <th><?= $this->lang->line("general_partner_type") ?></th>
                    <th><?= $this->lang->line("general_sll") ?></th>
                    <th><?= $this->lang->line("general_tax_addr") ?></th>
                    <th><?= $this->lang->line("general_is_customer") ?></th>
                    <th><?= $this->lang->line("general_is_supplier") ?></th>
                    <th><?= $this->lang->line("general_action") ?></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_partner); $i++) {
                    $focus = $m_partner[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->name ?></td>
                        <td><?= $focus->master ?></td>
                        <td><?= $focus->branch ?></td>
                        <td><?= $focus->partner_code ?></td>
                        <td><?= $focus->address_1 ?></td>
                        <td><?= $focus->address_2 ?></td>
                        <td><?= $focus->city ?></td>
                        <td><?= $focus->province ?></td>
                        <td><?= $focus->zip_code ?></td>
                        <td><?= $focus->phone ?></td>
                        <td><?= $focus->fax ?></td>
                        <td><?= $focus->email ?></td>
                        <td><?= $focus->tax_number ?></td>
                        <td><?= $focus->salesman ?></td>
                        <td><?= $focus->partner_type ?></td>
                        <td><?= $focus->sales_price_level ?></td>
                        <td><?= $focus->tax_address ?></td>
                        <td><?= $focus->is_customer ? $this->lang->line("general_yes") : $this->lang->line("general_no") ?></td>
                        <td><?= $focus->is_supplier ? $this->lang->line("general_yes") : $this->lang->line("general_no") ?></td>
                        <td nowrap="nowrap">
                            <?= $this->load->view("component/icon_button/edit", array("id" => $focus->id), true); ?>
                            <?= $this->load->view("component/icon_button/delete", array("id" => $focus->id), true); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
<?= $this->load->view("component/modal/partner/tambah_partner", "", true); ?>

<?= $this->load->view("component/modal/partner/ubah_hapus_partner", "", true); ?>