<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title m-0">
                    Daftar Barang Bebas
                </h5>
            </div>
            <div class="card-body daftar_barang_container pt-0">
                <input type="text" class="form-control my-4" placeholder="Cari Barang" onkeyup="suggester_me(this)" style="height: 30px;" />
                <div style="height: 50vh;">
                    <div class="scroll scroll-pull ps ps--active-y" data-scroll="true" data-wheel-propagation="true" style="max-height: 50vh; height: 100%; overflow: hidden;" id="goods_placement">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title m-0">
                    Daftar Barang <?= $data_salesman->name ?>
                </h5>
            </div>
            <div class="card-body daftar_barang_container pt-0">
                <input type="text" class="form-control my-4" placeholder="Cari Barang" onkeyup="suggester_my_map(this)" style="height: 30px;" />
                <div style="height: 50vh;">
                    <div class="scroll scroll-pull ps ps--active-y" data-scroll="true" data-wheel-propagation="true" style="max-height: 50vh; height: 100%; overflow: hidden;" id="my_goods_placement">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>