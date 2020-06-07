<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Reference
                </h3>
            </div>
            <form action="<?= current_url() ?>" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Group Data:</label>
                        <p class="form-control-plaintext text-muted"><?= $group_data ?></p>
                        <input type="hidden" name="group_data" value="<?= $group_data ?>">
                    </div>
                    <div class="form-group">
                        <label>Detail Data:</label>
                        <input type="text" name="detail_data" class="form-control" placeholder="Enter Detail Data" required />
                    </div>
                </div>
                <input type="hidden" name="back_url" value="<?= $_SERVER['HTTP_REFERER'] ?>">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit and Add More</button>
                    <button type="submit" name="back" value="<?= isset($back_url) ? $back_url : $_SERVER['HTTP_REFERER'] ?>" class="btn btn-primary mr-2">Submit and go back</button>
                    <a class="btn btn-secondary" href="<?= isset($back_url) ? $back_url : $_SERVER['HTTP_REFERER'] ?>">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>