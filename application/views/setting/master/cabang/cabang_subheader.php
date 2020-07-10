<div class="subheader py-2 py-lg-4" id="kt_subheader">
    <div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <a class="fa la-home mr-5 text-primary icon-md" href="<?= base_url() ?>"> </a>
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Daftar Cabang</h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Search Form-->
            <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?= count($data_branches) ?> Total</span>
                <div class="ml-5">
                    <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                        <input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Search...">
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <button type="button" class="btn btn-light-primary font-weight-bold btn-sm px-5 font-size-base ml-2" data-toggle="modal" data-target="#tambah_m_branch">Tambah Cabang</button>
            <!--end::Button-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>