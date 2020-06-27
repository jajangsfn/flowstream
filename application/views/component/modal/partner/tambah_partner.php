<div class="modal fade" id="tambah_m_partner" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukan Nama Partner" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukan Email" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kode Partner:</label>
                        <input type="text" name="partner_code" class="form-control" placeholder="Enter Partner Code" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Master:</label>
                        <select class="form-control select2" name="master_id">
                            <?php foreach ($m_master as $master_option) { ?>
                                <option value="<?= $master_option->id ?>"><?= $master_option->name ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/m_master") ?>">
                            <div class="my-2">
                                (Kelola Master)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Branch:</label>
                        <select class="form-control select2" name="branch_id">
                            <?php foreach ($m_branch as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->name ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/master/cabang") ?>">
                            <div class="my-2">
                                (Kelola Cabang)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_1">Address 1:</label>
                        <textarea class="form-control" id="address_1" name="address_1" placeholder="Enter Address" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_2">Address 2:</label>
                        <textarea class="form-control" id="address_2" name="address_2" placeholder="Enter Address" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>City:</label>
                        <input type="text" name="city" class="form-control" placeholder="Enter City" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Province:</label>
                        <input type="text" name="province" class="form-control" placeholder="Enter Province" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Zip Code:</label>
                        <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Fax:</label>
                        <input type="text" name="fax" class="form-control" placeholder="Enter Fax Number" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tax Number:</label>
                        <input type="text" name="tax_number" class="form-control" placeholder="Enter Tax Number" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Salesman:</label>
                        <input type="text" name="salesman" class="form-control" placeholder="Enter Salesman" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Partner Type:</label>
                        <input type="text" name="partner_type" class="form-control" placeholder="Enter Partner Type" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sales Price Level:</label>
                        <input type="text" name="sales_price_level" class="form-control" placeholder="Enter Sales Price Level" required />
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="tax_address">Tax Address:</label>
                        <textarea class="form-control" id="tax_address" name="tax_address" placeholder="Enter Tax Address" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-3 checkbox-list">
                    <div class="form-group">
                        <label>Mark:</label>
                        <label class="checkbox">
                            <input type="checkbox" name="is_customer" /> Mark As Customer
                            <span></span>
                        </label>
                        <label class="checkbox">
                            <input type="checkbox" name="is_supplier" /> Mark As Supplier
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>