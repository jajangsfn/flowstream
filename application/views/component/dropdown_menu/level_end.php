<li class="menu-item" aria-haspopup="true">
    <a <?= isset($blank) && $blank ? "target='_blank'" : "" ?> href="<?= $url ?>" class="menu-link">
        <?php if (isset($dot) && $dot) { ?>
            <i class="menu-bullet menu-bullet-dot">
                <span></span>
            </i>
        <?php } ?>
        <span class="menu-text">
            <?php if (isset($icon) && $icon) { ?>
                <i class="fa <?= $icon ?>"></i>
            <?php } ?>
            <?= $title ?>
        </span>
        <span class="menu-desc"></span>
    </a>
</li>
<?php $icon = null; ?>
<?php $blank = null; ?>
<?php $dot = null; ?>