<div class="form-group w-100">
    <label><?= $title ?></label>
    <select class="form-control select2" name="<?= $name ?>" <?= isset($id) ? "id='$id'" : "" ?>>
        <?php if (isset($selected) && $selected) { ?>

            <?php $found = false; ?>
            <?php foreach ($list as $option) { ?>
                <?php if ($selected == $option->$identifier) { ?>
                    <option value="<?= $option->$identifier ?>" selected><?= $option->$showable ?></option>
                    <?php $found = true; ?>
                <?php } else { ?>
                    <option value="<?= $option->$identifier ?>"><?= $option->$showable ?></option>
                <?php } ?>
            <?php } ?>
            <?php if (!$found) { ?>
                <option value="<?= $selected ?>" selected><?= $not_found_showable ?></option>
            <?php } ?>

        <?php } else { ?>
            <?php foreach ($list as $option) { ?>
                <?php if ($option->$showable == "General") : ?>
                    <option value="<?= $option->$identifier ?>" selected><?= $option->$showable ?></option>
                <?php else : ?>
                    <option value="<?= $option->$identifier ?>"><?= $option->$showable ?></option>
                <?php endif ?>
            <?php } ?>
        <?php } ?>
    </select>
    <a class="form-text text-info" href="<?= $manage_url ?>">
        <div class="my-2">
            (Kelola <?= $object_name ?>)
        </div>
    </a>
</div>