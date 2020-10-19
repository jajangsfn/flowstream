<?php if (current_url() != base_url("index.php")) : ?>
    <!--begin::Header Menu Wrapper-->
    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
        <div class="container">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default header-menu-root-arrow">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <?php $this->load->view("component/dropdown_menu/nav_mapper"); ?>
                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
    </div>
    <!--end::Header Menu Wrapper-->
<?php endif ?>