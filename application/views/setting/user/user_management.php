<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar User</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_sa">
                <i class="la la-plus"></i>Tambah Akun Super Admin
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="full_users_list">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Branch</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_sa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= base_url("/index.php/flowstream_api/v1/users/tambah_super_admin") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Super Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "user_id",
                    "type" => "text",
                    "required" => true,

                    "placeholder" => "Username",
                    "label" => "Username",
                    "help" => "Masukan username",

                    "value" => false
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "email",
                    "type" => "email",
                    "required" => true,

                    "placeholder" => "Email",
                    "label" => "Email",
                    "help" => "Masukan email",

                    "value" => false
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "password",
                    "type" => "password",
                    "required" => true,

                    "placeholder" => "Password",
                    "label" => "Password",
                    "help" => "Masukan password",

                    "value" => false
                ), true); ?>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>