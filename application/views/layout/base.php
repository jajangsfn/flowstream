<!DOCTYPE html>
<html lang="en">

<body id="kt_body" class="header-fixed subheader-enabled page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <?php $this->load->view("component/topbar"); ?>
                <?php if (!isset($no_header) || !$no_header) {
                    $this->load->view("component/header_menu");
                }
                ?>

                <?php if (!(isset($transactional) && $transactional)) : ?>
                    <!--begin::Container-->
                    <div class="d-flex flex-row flex-column-fluid container">
                        <!--begin::Content Wrapper-->
                        <div class="main d-flex flex-column flex-row-fluid">
                            <?php if (isset($page_subheader)) : ?>
                                <?= $page_subheader ?>
                            <?php else : ?>
                                <div class="subheader py-2 py-lg-4" id="kt_subheader">
                                    <div class="w-100 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center flex-wrap mr-1">
                                            <!--begin::Page Heading-->
                                            <div class="d-flex align-items-baseline mr-5">
                                                <!--begin::Page Title-->
                                                <?php if (isset($back_url)) : ?>
                                                    <a class="btn btn-light-primary mr-5" href="<?= $back_url ?>">
                                                        <i class="fa la-angle-left icon-md"></i>
                                                        kembali
                                                    </a>
                                                    <!-- <a class="fa la-angle-left mr-5 text-primary icon-md" href="<?= $back_url ?>"> </a> -->
                                                <?php else : ?>
                                                    <a class="fa la-home mr-5 text-primary icon-md" href="<?= base_url() ?>"> </a>
                                                <?php endif; ?>
                                                <h5 class="text-dark font-weight-bold my-2 mr-5">
                                                    <?= $page_title ?></h5>
                                                <!--end::Page Title-->
                                            </div>
                                            <!--end::Page Heading-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="container my-6 h-100">
                                <?= $page_content ?>
                            </div>
                        </div>
                    </div>
                    <!--end::Container-->
                <?php elseif (isset($transactional) && $transactional) : ?>
                    <!--begin::Container-->
                    <div class="d-flex flex-row flex-column-fluid mx-2">
                        <!--begin::Content Wrapper-->
                        <div class="main d-flex flex-column flex-row-fluid rounded">
                            <?php if (isset($page_subheader)) : ?>
                                <?= $page_subheader ?>
                            <?php else : ?>
                                <div class="subheader py-2 py-lg-4 rounded" id="kt_subheader">
                                    <div class="w-100 d-flex align-items-center container justify-content-between flex-wrap flex-sm-nowrap">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center flex-wrap mr-1">
                                            <!--begin::Page Heading-->
                                            <div class="d-flex align-items-baseline mr-5">
                                                <!--begin::Page Title-->
                                                <?php if (isset($back_url)) : ?>
                                                    <a class="btn btn-light-primary mr-5" href="<?= $back_url ?>">
                                                        <i class="fa la-angle-left icon-md"></i>
                                                        kembali
                                                    </a>
                                                <?php else : ?>
                                                    <a class="fa la-home mr-5 text-primary icon-md" href="<?= base_url() ?>"> </a>
                                                <?php endif; ?>
                                                <h5 class="text-dark font-weight-bold my-2 mr-5">
                                                    <?= $page_title ?>
                                                </h5>
                                                <!--end::Page Title-->
                                            </div>
                                            <!--end::Page Heading-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="px-10 my-6 h-100">
                                <?= $page_content ?>
                            </div>
                        </div>
                    </div>
                    <!--end::Container-->
                <?php endif ?>
                <?php $this->load->view("component/footer"); ?>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <?= isset($page_modal) ? $page_modal : "" ?>
    <?php $this->load->view("component/scroll_top_button"); ?>
</body>

</html>