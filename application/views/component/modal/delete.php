<div class="modal fade" id="delete_<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="modal-header">
                <h5 class="modal-title">Delete <?= $object_name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0"><?= $detail ?></p>
                <small class="m-0 text-info"><?= $subdetail ?></small>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/input/submit_button", array(
                    "name" => "delete",
                    "variant" => "danger",
                    "text" => "Delete"
                ), true); ?>
            </div>
        </form>
    </div>
</div>