<button type="submit" class="btn btn-<?= isset($variant) && $variant ? $variant : "primary" ?> mr-2" <?= isset($name) && $name ? "name='$name'" : "" ?>>
    <?= isset($text) && $text ? $text : "Send" ?>
</button>