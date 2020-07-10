<div class="modal fade" id="daftarBarang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="scroll scroll-pull" data-scroll="true" data-height="400">
                    <?php for ($i = 0; $i < 30; $i++) : ?>
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <!--begin::Section-->
                            <div class="d-flex align-items-center mr-2">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50 symbol-light mr-3 flex-shrink-0">
                                    <div class="symbol-label">
                                        <img src="<?= base_url() ?>/assets/media/svg/misc/006-plurk.svg" class="h-50" alt="">
                                    </div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Title-->
                                <div>
                                    <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Top Authors</a>
                                    <div class="font-size-sm text-muted font-weight-bold mt-1">Ricky Hunt, Sandra Trepp</div>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Label-->
                            <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">+82$</div>
                            <!--end::Label-->
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($goods as $good) : ?>
    <div class="modal fade" id="tambah_baru_<?= $good->id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah <?= $good->brand_description ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah_tambah_baru_<?= $good->id ?>">Jumlah <?= $good->brand_description ?></label>
                        <input type="number" id="jumlah_tambah_baru_<?= $good->id ?>" class="form-control" value="1" min="1">
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="tambah_barang(<?= $good->id ?>)">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>