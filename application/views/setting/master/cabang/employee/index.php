<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Employee</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_employee">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="employee_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Karyawan</th>
                    <th>Level</th>
                    <th>Posisi</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Tanggal Bergabung</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->


<div class="modal fade" id="tambah_employee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/add_employee") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <input type="hidden" name="branch_id" value="<?= $data_branch->id ?>">
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[name]",
                        "placeholder" => "Masukan Nama Employee",
                        "type" => "text",
                        "label" => "Nama:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[employee_number]",
                        "placeholder" => "Masukan Nomor Employee",
                        "type" => "text",
                        "label" => "Nomor Employee:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "emp[level_id]",
                        "title" => "Level Employee",

                        "list" => $levels,
                        "identifier" => "id",
                        "showable" => "detail_data",

                        "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/employee_level"),
                        "object_name" => "level",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "emp[position_id]",
                        "title" => "Posisi Employee",

                        "list" => $positions,
                        "identifier" => "id",
                        "showable" => "detail_data",

                        "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/employee_position"),
                        "object_name" => "posisi",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[birth]",
                        "placeholder" => "Masukan Tanggal Lahir Employee",
                        "type" => "date",
                        "label" => "Tanggal Lahir:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[join_date]",
                        "placeholder" => "Masukan Tanggal Bergabung Employee",
                        "type" => "date",
                        "label" => "Tanggal Bergabung:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[address]",
                        "placeholder" => "Masukan Alamat Employee",
                        "type" => "textarea",
                        "label" => "Alamat:",

                        "required" => false,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "usr[email]",
                        "placeholder" => "Masukan Email Employee",
                        "type" => "email",
                        "label" => "Email:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[phone_1]",
                        "placeholder" => "Masukan Nomor HP Employee",
                        "type" => "tel",
                        "label" => "Nomor HP:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[phone_2]",
                        "placeholder" => "Masukan Nomor HP 2 Employee (Bila ada)",
                        "type" => "tel",
                        "label" => "Nomor HP 2:",

                        "required" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "usr[user_id]",
                        "placeholder" => "Username Employee (Untuk Masuk Flowstream)",
                        "type" => "text",
                        "label" => "Username:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "usr[password]",
                        "placeholder" => "Password Awal (Untuk Masuk Flowstream)",
                        "type" => "password",
                        "label" => "Password:",

                        "required" => true,
                    ), true); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="edit_employee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/edit_employee") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <input type="hidden" name="id" id="id_edit">
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[name]",
                        "placeholder" => "Masukan Nama Employee",
                        "type" => "text",
                        "label" => "Nama:",

                        "id" => "name_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[employee_number]",
                        "placeholder" => "Masukan Nomor Employee",
                        "type" => "text",
                        "label" => "Nomor Employee:",

                        "id" => "employee_number_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "emp[level_id]",
                        "title" => "Level Employee",

                        "list" => $levels,
                        "identifier" => "id",
                        "showable" => "detail_data",

                        "id" => "level_id_edit",

                        "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/employee_level"),
                        "object_name" => "level",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "emp[position_id]",
                        "title" => "Posisi Employee",

                        "list" => $positions,
                        "identifier" => "id",
                        "showable" => "detail_data",

                        "id" => "position_id_edit",

                        "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/employee_position"),
                        "object_name" => "posisi",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[birth]",
                        "placeholder" => "Masukan Tanggal Lahir Employee",
                        "type" => "date",
                        "label" => "Tanggal Lahir:",

                        "id" => "birth_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[join_date]",
                        "placeholder" => "Masukan Tanggal Bergabung Employee",
                        "type" => "date",
                        "label" => "Tanggal Bergabung:",

                        "id" => "join_date_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[address]",
                        "placeholder" => "Masukan Alamat Employee",
                        "type" => "textarea",
                        "label" => "Alamat:",

                        "id" => "address_edit",

                        "required" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[phone_1]",
                        "placeholder" => "Masukan Nomor HP Employee",
                        "type" => "tel",
                        "label" => "Nomor HP:",

                        "id" => "phone_1_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "emp[phone_2]",
                        "placeholder" => "Masukan Nomor HP 2 Employee (Bila ada)",
                        "type" => "tel",
                        "label" => "Nomor HP 2:",

                        "id" => "phone_2_edit",

                        "required" => false,
                    ), true); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_employee") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Nonaktifkan Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menonaktifkan employee ini</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger mr-2">Nonaktifkan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="active_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/activate_employee") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_active">
            <div class="modal-header">
                <h5 class="modal-title">Aktifkan Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan mengaktifkan employee ini</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-primary mr-2">Aktifkan</button>
            </div>
        </form>
    </div>
</div>