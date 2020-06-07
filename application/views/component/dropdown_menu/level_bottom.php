<li class="menu-item" aria-haspopup="true">
    <a href="<?= base_url($nav_data->url) ?>" class="menu-link">
        <?php if (!$nav_data->icon) { ?>
            <i class="menu-bullet menu-bullet-dot">
                <span></span>
            </i>
        <?php } ?>
        <span class="menu-text">
            <?php if ($nav_data->icon) { ?>
                <i class="fa <?= $nav_data->icon ?> mr-3"></i>
            <?php } ?>
            <?= $nav_data->title ?>
        </span>
        <span class="menu-desc"></span>
    </a>
</li>