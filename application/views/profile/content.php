<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::User-->
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?= $this->session->username; ?></a>
                                <div class="text-muted">
                                    <?= $this->session->role_code == "ROLE_SUPER_ADMIN" ? "Administrator" : ""; ?>
                                </div>
                            </div>
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <?php if ($this->session->level || $this->session->position) : ?>
                <div class="col-md-12">
                    <div class="card mt-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Contact-->
                            <?php if ($this->session->level) : ?>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Level:</span>
                                    <span class="text-muted">
                                        <?= $this->session->level; ?>
                                    </span>
                                </div>
                            <?php endif ?>
                            <?php if ($this->session->position) : ?>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Position:</span>
                                    <span class="text-muted">
                                        <?= $this->session->position; ?>
                                    </span>
                                </div>
                            <?php endif ?>
                            <!--end::Contact-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="col-md-8">
        <form class="form card card-custom" method="POST" action="<?= base_url("/index.php/api/change_password") ?>">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Change Password</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" class="form-control form-control-lg form-control-solid" value="" name="current_password" placeholder="Current password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" id="new_password" class="form-control form-control-lg form-control-solid" value="" name="new_password" placeholder="New password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" id="verify_password" class="form-control form-control-lg form-control-solid" value="" placeholder="Verify password" required>
                    </div>
                </div>
            </div>
            <!--end::Form-->
        </form>
    </div>
</div>