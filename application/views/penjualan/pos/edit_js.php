<script>
    var branch_id = 0;
    var index_harga = 0;

    $(document).ready(function() {
        $('.select2').select2({
            width: "100%"
        });
        $('#pilih_customer').select2({
            placeholder: "Pilih Customer",
            width: "100%"
        });

        $(".late_numeral").each(function() {
            $(this).text(
                numeral($(this).text()).format('0,[.]00')
            );
        })

        change_payment_method();

        branch_id = <?= $data_branch->id ?>;
        index_harga = <?= $data_pos->index_harga ?>;
        customer_id = <?= $data_pos->partner_id ?>;

        // get list barang
        $.ajax({
            method: "get",
            url: "<?= base_url("/index.php/api/barang_cabang/") ?>" + branch_id,
            success: function(result) {
                $("#order_request_col").addClass("col-lg-9").removeClass("col-lg-12");
                $("#daftar_barang_col_lg").addClass("d-lg-block");
                $(".goods_placement").empty();
                $("#pilih_barang_modal_toggle").removeClass("d-none").addClass("d-unset d-lg-none");
                for (let i = 0; i < result.data.length; i++) {
                    const focus = result.data[i];

                    const keyword = (focus.brand_name + focus.brand_description + focus.barcode).replace(/ /g, '').toLowerCase();
                    const target = $(document.createElement("div"))
                        .addClass("d-flex align-items-center justify-content-between mb-5 text-dark-75 text-hover-primary")
                        .click(() => add_modal(focus.id))
                        .attr("style", "cursor: pointer")
                        .attr("data-keyword", keyword)
                        .attr("data-id-barang-passable", focus.id)
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
                    $(".goods_placement").append(target)
                }
            }
        })
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

    function add_modal(id_barang) {
        console.log("here")
        $.ajax({
            method: "get",
            url: "<?= base_url("/index.php/api/get_barang/") ?>" + id_barang,
            success: function(result) {
                const focus = result.data;
                let price;
                if (focus["price_" + index_harga]) {
                    price = focus["price_" + index_harga];
                } else {
                    price = focus["default_price"];
                }
                $("#nama_barang_tambah").text(focus.brand_name);
                $("#desk_barang_tambah").text(focus.brand_description);
                $("#barcode_barang_tambah").text(focus.barcode);
                $("#harga_barang_tambah").text(price ? numeral(price).format('0,[.]00') : 0);
                $("#unit_barang_tambah").text(" / " + focus.unit);
                $("#tombol_tambah_baru").attr("data-id-barang", focus.id)

                $("#tambah_barang").modal("show");
            },
            error: function(resp) {
                console.log(resp.responseText);
            }
        });
    }

    function delete_baris(id) {
        $subtotal_sebelumnya = parseInt($("#total_harga_" + id).text());
        $total_sebelumnya = parseInt($("#total_harga_order").text());
        $("#total_harga_order").text(numeral($total_sebelumnya - $subtotal_sebelumnya).format('0,[.]00'));
        $("#tax_price").text(numeral(10 * ($total_sebelumnya - $subtotal_sebelumnya) / 100).format('0,[.]00'));
        $("#total_harga_order_tax").text(numeral(110 * ($total_sebelumnya - $subtotal_sebelumnya) / 100).format('0,[.]00'));
        $("#total_pembayaran").val(110 * ($total_sebelumnya - $subtotal_sebelumnya) / 100);

        $("#" + id).remove();
        render_table_number();

        if ($("table#daftar_barang_order tbody").children().length > 0) {
            $("#payment-button").removeAttr("disabled");
        } else {
            $("#payment-button").attr("disabled", "disabled");
        }
    }

    function render_table_number() {
        $("table#daftar_barang_order tbody td:first-child").each(function(index, elem) {
            $(elem).text(index + 1);
        })
        if ($("table#daftar_barang_order tbody th:first-child").length === 0) {
            $("#payment-button").attr("disabled", "disabled");
        } else {
            $("#payment-button").removeAttr("disabled");
        }
    }

    function hitung_ulang(id) {
        // kurangi total saat ini dengan subtotal sebelumnya
        $subtotal_sebelumnya = parseInt($("#total_harga_" + id).text());
        $total_sebelumnya = parseInt($("#total_harga_order").text());
        $total_bersih = $total_sebelumnya - $subtotal_sebelumnya;

        // hitung ulang baris ini
        $harga = $("#harga_" + id).val();
        $jumlah = $("#jumlah_" + id).val();
        $diskon_harga = 1 - ($("#diskon_" + id).val() / 100);
        $subtotal_baru = $harga * $jumlah * $diskon_harga;

        // bulatkan ke 2 desimal
        $subtotal_baru = Math.round($subtotal_baru * 1000) / 1000;

        // Pasang sbg subtotal baru
        $("#total_harga_" + id).text(numeral($subtotal_baru).format('0,[.]00'));

        // Tambahkan ke total bersih
        $("#total_harga_order").text(numeral($total_bersih + $subtotal_baru).format('0,[.]00'));
        $("#tax_price").text(numeral(10 * ($total_bersih + $subtotal_baru) / 100).format('0,[.]00'));
        $("#total_harga_order_tax").text(numeral(110 * ($total_bersih + $subtotal_baru) / 100).format('0,[.]00'));
        $("#total_pembayaran").val(numeral(110 * ($total_bersih + $subtotal_baru) / 100).format('0,[.]00'));

        if ($("table#daftar_barang_order tbody").children().length > 0) {
            $("#payment-button").removeAttr("disabled");
        } else {
            $("#payment-button").attr("disabled", "disabled");
        }
    }

    function tambah_barang(element) {
        const id = $(element).attr("data-id-barang");

        // cek jika barang sudah pernah dimasukan
        var same_found = false;
        $("table#daftar_barang_order tbody tr").each(function(rower) {
            if ($(this).attr("id") == id) {
                same_found = true;
            };
        });

        if (same_found) {

            // jika sudah pernah dimasukan, tambahkan quantity dan hitung ulang
            $(`tr#${id}`).animate({
                opacity: 0
            });
            $(`input#jumlah_${id}`).val(
                parseInt(
                    $(`input#jumlah_${id}`).val()
                ) +
                (
                    parseInt(
                        $("#jumlah_tambah_baru").val()
                    ) *
                    parseInt(
                        $(`#jumlah_${id}`).attr("step")
                    )
                )
            );
            $(`tr#${id}`).animate({
                opacity: 1
            });

            hitung_ulang(id)
        } else {
            // ambil info barang dengan ajax
            $.ajax({
                url: "<?= base_url("/index.php/api/get_barang/") ?>" + id,
                success: function(response) {
                    let price;
                    if (response.data["price_" + index_harga]) {
                        price = response.data["price_" + index_harga];
                    } else {
                        price = response.data["default_price"];
                    }

                    price = price ? parseInt(price) : 0;
                    $jumlah_baru = $("#jumlah_tambah_baru").val();

                    // cek ratio_flag
                    if (response.data.ratio_flag == 1) {
                        $jumlah_baru = $jumlah_baru * response.data.converted_quantity;
                    }

                    $subtotal_baru = $jumlah_baru * price;
                    const data = response.data;
                    $("table#daftar_barang_order tbody").append(
                        $(document.createElement("tr")).attr("id", data.id).append(
                            // numbering
                            $(document.createElement("td")).addClass("text-center font-weight-bold"),

                            // kode barang dan id input hidden
                            $(document.createElement("td")).append(
                                $(document.createElement("div")).text(data.barcode),
                                $(document.createElement("input"))
                                .attr("type", "hidden")
                                .attr("name", `barang[${data.id}][goods_id]`)
                                .attr("value", data.id)
                            ),

                            // nama barang
                            $(document.createElement("td")).append(
                                $(document.createElement("div")).text(data.brand_name).addClass("font-weight-bold"),
                                $(document.createElement("div")).text(data.brand_description).addClass(`brand_description_show ${show_desc ? "" : "d-none"}`),
                                $(document.createElement("input"))
                                .attr("type", "hidden")
                                .attr("name", `barang[${data.id}][goods_name]`)
                                .attr("value", data.brand_name + " - " + data.brand_description)
                            ),

                            // jumlah barang
                            $(document.createElement("td")).attr("style", "width: 90px").append(
                                $(document.createElement("input"))
                                .attr("type", "number")
                                .addClass("form-control text-center")
                                .attr("id", "jumlah_" + data.id)
                                .attr("name", `barang[${data.id}][quantity]`)
                                .val($jumlah_baru)
                                .attr("min", data.ratio_flag == 1 ? data.converted_quantity : 1)
                                .attr("step", data.ratio_flag == 1 ? data.converted_quantity : 1)
                                .change(() => hitung_ulang(data.id))
                            ),

                            // unit barang
                            $(document.createElement("td")).text(data.ratio_flag == 1 ? "Pieces" : data.unit),

                            $(document.createElement("td")).append(
                                $(document.createElement("input"))
                                .attr("type", "number")
                                .addClass("form-control text-right rupiah")
                                .attr("id", "harga_" + data.id)
                                .attr("name", `barang[${data.id}][price]`)
                                .val(price)
                                .attr("min", "1")
                                .change(() => hitung_ulang(data.id))
                            ),

                            // diskon (TODO)
                            $(document.createElement("td")).attr("style", "width: 90px").append(
                                $(document.createElement("input"))
                                .attr("type", "number")
                                .addClass("form-control text-center")
                                .attr("style", "width: 100%")
                                .attr("id", "diskon_" + data.id)
                                .attr("name", `barang[${data.id}][discount]`)
                                .val(0)
                                .attr("min", "0")
                                .attr("max", "100")
                                .change(() => hitung_ulang(data.id)),
                            ),

                            // subtotal
                            $(document.createElement("td")).text(numeral($subtotal_baru).format('0,[.]00')).addClass("text-right rupiah").attr("id", "total_harga_" + data.id),

                            // aksi hapus
                            $(document.createElement("td")).addClass("text-center").append(
                                $(document.createElement("button"))
                                .addClass("mr-3 btn btn-icon btn-light btn-hover-primary btn-sm")
                                .attr("type", "button")
                                .click(() => delete_baris(data.id))
                                .append($("#trash_button_icon_template").clone().removeAttr("id").removeClass("d-none"))
                            ),
                        )
                    );
                    render_table_number();
                    $total_sebelumnya = parseInt($("#total_harga_order").text());
                    $("#total_harga_order").text(numeral($total_sebelumnya + $subtotal_baru).format('0,[.]00'));
                    $("#tax_price").text(numeral(10 * ($total_sebelumnya + $subtotal_baru) / 100).format('0,[.]00'));
                    $("#total_harga_order_tax").text(numeral(110 * ($total_sebelumnya + $subtotal_baru) / 100).format('0,[.]00'));
                    $("#total_pembayaran").val(numeral(110 * ($total_sebelumnya + $subtotal_baru) / 100).format('0,[.]00'));

                    // tombol submit
                    $("#payment-button").removeAttr("disabled");
                }
            })
        }
    }

    function suggester_me(event, element) {
        const searchtarget = $(element).val().replace(/ /g, '').toLowerCase();
        let total_found = 0;
        let id_barang = 0;
        $('.goods_placement').children('div.align-items-center.justify-content-between.mb-5.text-dark-75.text-hover-primary').each(function() {
            var targetkey = $(this).attr("data-keyword");
            if (targetkey.indexOf(searchtarget) >= 0) {
                $(this).removeClass("d-none")
                $(this).addClass("d-flex")
                total_found++;
                id_barang = $(this).attr("data-id-barang-passable");
            } else {
                $(this).addClass("d-none")
                $(this).removeClass("d-flex")
            }
        });
        if (event.key == "Enter") {
            // 2 karena fungsi each juga cari yang di dalam modal
            if (total_found == 2) {
                // auto add
                tambah_barang($(document.createElement("div")).attr("data-id-barang", id_barang));

                // clear
                $(element).val("");

                // show all
                $('.goods_placement').children('div.align-items-center.justify-content-between.mb-5.text-dark-75.text-hover-primary').each(function() {
                    $(this).removeClass("d-none")
                    $(this).addClass("d-flex")
                });
            };
        }
    }

    var show_desc = true;

    function toggleshow() {
        $(".brand_description_show").toggleClass("d-none");
        show_desc = !show_desc;
    }

    function salesman_changed() {
        $("#salesman_input").val(
            $("#pilih_salesman option:selected").text()
        )
    }

    function change_payment_method() {
        switch ($("#payment_method").val()) {
            case "CASH":
                $("#nama_bank_cell").fadeOut();
                $("#jumlah_bayar_cell").removeClass("col-lg-4").addClass("col-lg-6");
                $("#payment_method_cell").removeClass("col-lg-4").addClass("col-lg-6");
                break;
            default:
                $("#nama_bank_cell").fadeIn();
                $("#jumlah_bayar_cell").removeClass("col-lg-6").addClass("col-lg-4");
                $("#payment_method_cell").removeClass("col-lg-6").addClass("col-lg-4");
                break;
        }
    }
</script>

<span class="svg-icon svg-icon-md svg-icon-primary d-none" id="trash_button_icon_template">
    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"></rect>
            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
        </g>
    </svg>
    <!--end::Svg Icon-->
</span>
