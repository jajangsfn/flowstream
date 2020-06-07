<li class="menu-item menu-item-submenu menu-item-rel <?= (isset($unidentifier) && stripos(current_url(), $identifier) && !stripos(current_url(), $unidentifier)) || (!isset($unidentifier) && stripos(current_url(), $identifier)) ? "menu-item-here" : "" ?>" data-menu-toggle="click" aria-haspopup="true">
    <?php if (isset($url)) { ?>
        <a href="<?= base_url($url) ?>" class="menu-link">
            <span class="menu-text">
                <?php if (isset($icon)) { ?>
                    <i class="fa <?= $icon ?> mr-3"></i>
                <?php } ?>
                <?= $title ?>
            </span>
        </a>
    <?php } else { ?>
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text">
                <?php if (isset($icon)) { ?>
                    <i class="fa <?= $icon ?> mr-3"></i>
                <?php } ?>
                <?= $title ?>
            </span>
            <span class="menu-desc"></span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                <?php foreach ($links as $link) { ?>
                    <?php if (isset($link['url'])) { ?>
                        <?=
                            $this->load->view("component/dropdown_menu/level_end", array(
                                "dot" => false,
                                "url" => base_url($link['url']),
                                "title" => $link['title'],
                            ), true);
                        ?>
                    <?php } else { ?>
                        <?=
                            $this->load->view("component/dropdown_menu/level_1", array(
                                "title" => $link['title'],
                                "links" => $link['links']
                            ), true);
                        ?>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</li>