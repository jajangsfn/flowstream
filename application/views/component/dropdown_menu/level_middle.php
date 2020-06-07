<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="menu-text"><?= $nav_data->title ?></span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu menu-submenu-classic menu-submenu-right">
        <ul class="menu-subnav">
            <?php foreach ($nav_data->links as $link) { ?>
                <?=
                    $this->load->view("component/dropdown_menu/level_" . ($link->url ? "bottom" : "middle"), array(
                        "nav_data" => $link
                    ), true);
                ?>
            <?php } ?>
        </ul>
    </div>
</li>