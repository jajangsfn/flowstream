<div class="form-group">
    <label for="<?= isset($id) && $id ? $id : $name ?>" <?= isset($required) && $required ? "class='required'" : "" ?>><?= $label ?></label>
    <?php if ($type == "textarea") { ?>
        <textarea class="form-control" id="<?= isset($id) && $id ? $id : $name ?>" name="<?= $name ?>" placeholder="<?= $placeholder ?>" rows="<?= isset($row) && $row ? $row : "3" ?>" <?= isset($required) && $required ? "required" : "" ?>><?= isset($value) && $value ? $value : "" ?></textarea>
    <?php } else if ($type == "text" || $type == "number" || $type == "date" || $type == "email") { ?>
        <input type="<?= $type ?>" name="<?= $name ?>" class="form-control" <?= isset($id) && $id ? "id='$id'" : "" ?> <?= isset($placeholder) && $placeholder ? "placeholder='$placeholder'" : "" ?> <?= isset($required) && $required ? "required" : "" ?> <?= isset($value) && $value ? "value='$value'" : "" ?> <?= isset($autocomplete) && $autocomplete ? "autocomplete='" . $autocomplete . "'" : "" ?> <?= isset($maxlength) && $maxlength ? "maxlength='" . $maxlength . "'" : "" ?> />
        <span class="form-text text-muted"><?= isset($help) ? $help : "" ?></span>
    <?php } ?>
</div>