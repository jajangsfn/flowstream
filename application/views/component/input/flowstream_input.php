<div class="form-group">
    <label for="<?= $name ?>"><?= $label ?></label>
    <?php if ($type == "textarea") { ?>
        <textarea class="form-control" id="<?= $name ?>" name="<?= $name ?>" placeholder="<?= $placeholder ?>" rows="3"><?= isset($content) ? $content : "" ?></textarea>
    <?php } else { ?>
    <?php } ?>
</div>