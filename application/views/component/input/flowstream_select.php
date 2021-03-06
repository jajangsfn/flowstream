<div class="form-group w-100">
    <label class="<?= isset($required) && $required ? "required" : "" ?>"><?= $title ?></label>
    <select class="form-control select2" name="<?= $name ?>" data-width="100%"  <?= isset($id) ? "id='$id'" : "" ?> <?= isset($required) && $required ? "required" : "" ?>>
        <?php if (isset($required) && $required) : ?>
        <?php else : ?>
            <option value="" selected>None</option>
        <?php endif ?>
        <?php if (
            (isset($selected) && $selected)
            ||
            (isset($selected_showable) && $selected_showable)
        ) { ?>

            <?php $found = false; ?>
            <?php foreach ($list as $option) { ?>
                <?php if (isset($selected) && $selected) { ?>
                    <?php if ($selected == $option->$identifier) { ?>
                        <option value="<?= $option->$identifier ?>" selected><?= $option->$showable ?></option>
                        <?php $found = true; ?>
                    <?php } else { ?>
                        <option value="<?= $option->$identifier ?>"><?= $option->$showable ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <?php if ($selected_showable == $option->$showable) { ?>
                        <option value="<?= $option->$identifier ?>" selected><?= $option->$showable ?></option>
                        <?php $found = true; ?>
                    <?php } else { ?>
                        <option value="<?= $option->$identifier ?>"><?= $option->$showable ?></option>
                    <?php } ?>
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
    <?php if ($manage_url) : ?>
        <a class="form-text text-info" href="<?= $manage_url ?>">
            <div class="my-2">
                (Kelola <?= $object_name ?>)
            </div>
        </a>
    <?php endif ?>
</div>
