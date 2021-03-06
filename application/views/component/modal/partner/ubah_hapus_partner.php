<?php for ($i = 0; $i < count($m_partner); $i++) {
    $focus = $m_partner[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Partner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required value="<?= $focus->name ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukan Email Partner" required value="<?= $focus->email ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Partner Code:</label>
                            <input type="text" name="partner_code" class="form-control" placeholder="Enter Partner Code" required value="<?= $focus->partner_code ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>Master:</label>
                            <select class="form-control select2" name="master_id">
                                <?php $found = false; ?>
                                <?php foreach ($m_master as $option) { ?>
                                    <?php if ($focus->master_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->master_id ?>" selected><?= $focus->master ?> <span>(Deleted)</span></option>
                                    <?php $found = false; ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/m_master") ?>">
                                <div class="my-2">
                                    (Manage Master)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>Branch:</label>
                            <select class="form-control select2" name="branch_id">
                                <?php $found = false; ?>
                                <?php foreach ($m_branch as $option) { ?>
                                    <?php if ($focus->branch_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->branch_id ?>" selected><?= $focus->branch ?> <span>(Deleted)</span></option>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                                <div class="my-2">
                                    (Manage Branch)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_1_<?= $focus->id ?>">Address 1:</label>
                            <textarea class="form-control" id="address_1_<?= $focus->id ?>" name="address_1" placeholder="Enter Address" rows="3"><?= $focus->address_1 ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_2_<?= $focus->id ?>">Address 2:</label>
                            <textarea class="form-control" id="address_2_<?= $focus->id ?>" name="address_2" placeholder="Enter Address" rows="3"><?= $focus->address_2 ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>City:</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter City" required value="<?= $focus->city ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Province:</label>
                            <input type="text" name="province" class="form-control" placeholder="Enter Province" required value="<?= $focus->province ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Zip Code:</label>
                            <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code" required value="<?= $focus->zip_code ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" required value="<?= $focus->phone ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fax:</label>
                            <input type="text" name="fax" class="form-control" placeholder="Enter Fax Number" required value="<?= $focus->fax ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tax Number:</label>
                            <input type="text" name="tax_number" class="form-control" placeholder="Enter Tax Number" required value="<?= $focus->tax_number ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Salesman:</label>
                            <input type="text" name="salesman" class="form-control" placeholder="Enter Salesman" required value="<?= $focus->salesman ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Partner Type:</label>
                            <input type="text" name="partner_type" class="form-control" placeholder="Enter Partner Type" required value="<?= $focus->partner_type ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sales Price Level:</label>
                            <input type="text" name="sales_price_level" class="form-control" placeholder="Enter Sales Price Level" required value="<?= $focus->sales_price_level ?>" />
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="tax_address_<?= $focus->id ?>">Tax Address:</label>
                            <textarea class="form-control" id="tax_address_<?= $focus->id ?>" name="tax_address" placeholder="Enter Tax Address" rows="3"><?= $focus->tax_address ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-3 checkbox-list">
                        <div class="form-group">
                            <label>Mark:</label>
                            <label class="checkbox">
                                <input type="checkbox" name="is_customer" <?= $focus->is_customer ? "checked" : "" ?> /> Mark As Customer
                                <span></span>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="is_supplier" <?= $focus->is_supplier ? "checked" : "" ?> /> Mark As Supplier
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
    <div class="modal fade" id="delete_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Partner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus data partner <?= $focus->name ?> (<?= $focus->partner_code ?>)</p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan partner ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>