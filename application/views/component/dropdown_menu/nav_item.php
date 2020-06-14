<li class="menu-item menu-item-submenu menu-item-rel 
<?php if ($nav_data->identifier && stripos(current_url(), $nav_data->identifier)) {
    echo "menu-item-here";
} ?>" data-menu-toggle="click" aria-haspopup="true">
    <?php if ($nav_data->url) { ?>

        <a href="<?= base_url($nav_data->url) ?>" class="menu-link">
            <span class="menu-text">
                <?php if ($nav_data->icon) { ?>
                    <i class="fa <?= $nav_data->icon ?> mr-3"></i>
                <?php } ?>
                <?= $nav_data->title ?>
            </span>
        </a>

    <?php } else { ?>

        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text">
                <?php if ($nav_data->icon) { ?>
                    <i class="fa <?= $nav_data->icon ?> mr-3"></i>
                <?php } ?>
                <?= $nav_data->title ?>
            </span>
            <span class="menu-desc"></span>
            <i class="menu-arrow"></i>
        </a>

        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                <?php foreach ($nav_data->links as $link) { ?>
                    <?php if ($link->url) {; ?>
                        <?=
                            $this->load->view("component/dropdown_menu/level_bottom", array(
                                "nav_data" => $link,
                            ), true);
                        ?>
                    <?php } else { ?>
                        <?=
                            $this->load->view("component/dropdown_menu/level_middle", array(
                                "nav_data" => $link,
                            ), true);
                        ?>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</li>