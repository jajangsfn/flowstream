<script src="<?= base_url("/assets/js/pages/features/miscellaneous/bootstrap-notify.js") ?>"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            method: "get",
            url: "<?= base_url("/index.php/api/barang_cabang/$data_branch->id") ?>",
            success: function(result) {
                for (let i = 0; i < result.data.length; i++) {
                    const focus = result.data[i];

                    const keyword = (focus.brand_name + focus.brand_description + focus.barcode).replace(/ /g, '').toLowerCase();
                    const target = $(document.createElement("div"))
                        .addClass("d-flex align-items-center justify-content-between mb-5 text-dark-75 text-hover-primary")
                        .attr("style", "cursor: pointer")
                        .attr("data-keyword", keyword)
                        .append(
                            $(document.createElement("div"))
                            .addClass("d-flex justify-content-center flex-column mr-2")
                            .append(
                                $(document.createElement("div"))
                                .append(
                                    $(document.createElement("span"))
                                    .addClass("font-size-h6 font-weight-bolder")
                                    .text(focus.brand_name)
                                ),
                                $(document.createElement("span"))
                                .text(focus.brand_description)
                            ),
                            $(document.createElement("button"))
                            .attr("type", "button")
                            .addClass("btn btn-white text-primary")
                            .append(
                                $(document.createElement("i")).addClass("fa text-primary fa-angle-right p-0")
                            )
                        );

                    target.click(() => add_barang(target, focus.id))
                    $("#goods_placement").append(target)
                }

                $.ajax({
                    method: "get",
                    url: "<?= base_url("/index.php/api/barang_salesman/$data_salesman->id") ?>",
                    success: function(result) {
                        for (let i = 0; i < result.data.length; i++) {
                            const focus = result.data[i];

                            const keyword = (focus.brand_name + focus.brand_description + focus.barcode).replace(/ /g, '').toLowerCase();
                            const target = $(document.createElement("div"))
                                .addClass("d-flex align-items-center justify-content-between mb-5 text-dark-75 text-hover-primary")
                                .attr("style", "cursor: pointer")
                                .attr("data-keyword", keyword)
                                .append(
                                    $(document.createElement("button"))
                                    .attr("type", "button")
                                    .addClass("btn btn-white text-primary")
                                    .append(
                                        $(document.createElement("i")).addClass("fa text-primary fa-angle-left p-0")
                                    ),
                                    $(document.createElement("div"))
                                    .addClass("d-flex justify-content-center flex-column mr-2")
                                    .append(
                                        $(document.createElement("div")).addClass("text-right")
                                        .append(
                                            $(document.createElement("span"))
                                            .addClass("font-size-h6 font-weight-bolder")
                                            .text(focus.brand_name)
                                        ),
                                        $(document.createElement("span"))
                                        .text(focus.brand_description)
                                    )
                                );
                            target.click(() => remove_barang(target, focus.id))
                            $("#my_goods_placement").append(target)

                            // hide on left panel
                            $('#goods_placement').children(`[data-keyword=${keyword}]`).each(function() {
                                $(this).attr("data-hide", "true");
                            });
                        }
                    }
                });

            }
        });

        $(".daftar_barang_container").bind("mousewheel DOMMouseScroll", function(e) {
            var scrollTo = null;

            if (e.type == 'mousewheel') {
                scrollTo = (e.originalEvent.wheelDelta * -1);
            } else if (e.type == 'DOMMouseScroll') {
                scrollTo = 40 * e.originalEvent.detail;
            }

            if (scrollTo) {
                e.preventDefault();
                $(this).scrollTop(scrollTo + $(this).scrollTop());
            }
        })
    })

    function suggester_me(element) {
        const searchtarget = $(element).val().replace(/ /g, '').toLowerCase();
        $('#goods_placement').children('div.align-items-center.justify-content-between.mb-5.text-dark-75.text-hover-primary').each(function() {
            var targetkey = $(this).attr("data-keyword");
            if (targetkey.indexOf(searchtarget) >= 0) {
                $(this).removeClass("d-none")
                $(this).addClass("d-flex")
            } else {
                $(this).addClass("d-none")
                $(this).removeClass("d-flex")
            }
        });
    }

    function suggester_my_map(element) {
        const searchtarget = $(element).val().replace(/ /g, '').toLowerCase();
        $('#my_goods_placement').children('div.align-items-center.justify-content-between.mb-5.text-dark-75.text-hover-primary').each(function() {
            var targetkey = $(this).attr("data-keyword");
            if (targetkey.indexOf(searchtarget) >= 0) {
                $(this).removeClass("d-none")
                $(this).addClass("d-flex")
            } else {
                $(this).addClass("d-none")
                $(this).removeClass("d-flex")
            }
        });
    }

    function add_barang(element, id) {
        // move box to right
        $.ajax({
            method: "get",
            url: "<?= base_url("/index.php/api/barang/") ?>" + id,
            success: function(result) {
                const focus = result.data[0];

                const keyword = (focus.brand_name + focus.brand_description + focus.barcode).replace(/ /g, '').toLowerCase();
                const target = $(document.createElement("div"))
                    .addClass("d-flex align-items-center justify-content-between mb-5 text-dark-75 text-hover-primary")
                    .attr("style", "cursor: pointer")
                    .attr("data-keyword", keyword)
                    .append(
                        $(document.createElement("button"))
                        .attr("type", "button")
                        .addClass("btn btn-white text-primary")
                        .append(
                            $(document.createElement("i")).addClass("fa text-primary fa-angle-left p-0")
                        ),
                        $(document.createElement("div"))
                        .addClass("d-flex justify-content-center flex-column mr-2")
                        .append(
                            $(document.createElement("div")).addClass("text-right")
                            .append(
                                $(document.createElement("span"))
                                .addClass("font-size-h6 font-weight-bolder")
                                .text(focus.brand_name)
                            ),
                            $(document.createElement("span"))
                            .text(focus.brand_description)
                        )
                    );
                target.click(() => remove_barang(target, focus.id))
                $("#my_goods_placement").append(target);

                element.attr("data-hide", "true");
            }
        });

        // register mapping
        $.ajax({
            method: "get",
            url: "<?= base_url("/index.php/api/add_salesman_map/") ?>" + id + "/<?= $data_salesman->id ?>",
            success: function(result) {
                $.notify({
                    message: "Mapping berhasil ditambahkan"
                }, {
                    type: 'info',
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
        });
    }

    function remove_barang(element, id) {
        // show box in left panel
        const keyword = element.attr("data-keyword");
        $('#goods_placement').children(`[data-keyword=${keyword}]`).each(function() {
            $(this).attr("data-hide", "false");
        });

        // remove box from right panel
        element.remove();

        // remove mapping
        $.ajax({
            method: "get",
            url: "<?= base_url("/index.php/api/remove_salesman_map/") ?>" + id + "/<?= $data_salesman->id ?>",
            success: function(result) {
                $.notify({
                    message: "Mapping berhasil dihapus"
                }, {
                    type: 'info',
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutUp'
                    }
                });
            }
        });
    }
</script>