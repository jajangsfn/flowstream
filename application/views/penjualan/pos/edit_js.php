<script>
    var branch_id = 0;
    var index_harga = 0;

    $(document).ready(function() {
        $('.select2').select2({
            width: "100%"
        });

        $(".late_numeral").each(function() {
            $(this).text(
                numeral($(this).text()).format('0,[.]00')
            );
        })

        branch_id = <?= $data_branch->id ?>;
        index_harga = <?= $data_pos->index_harga ?>;
        customer_id = <?= $data_pos->partner_id ?>;

        // get list barang
        $.ajax({
            method: "post",
            data: {
                "branch_id": branch_id
            },
            url: "<?= base_url("/index.php/api/barang_for_customer") ?>",
            success: function(result) {
                $("#order_request_col").addClass("col-lg-9").removeClass("col-lg-12");
                $("#daftar_barang_col_lg").addClass("d-lg-block");
                $(".goods_placement").empty();
                $("#pilih_barang_modal_toggle").removeClass("d-none").addClass("d-unset d-lg-none");
                var target = "";
                for (let i = 0; i < result.data.length; i++) {

                    target +=
                        `
                                    <div 
                                        class="d-flex align-items-center justify-content-between mb-5 text-dark-75 text-hover-primary"
                                        onclick="add_modal(${result.data[i].id})"
                                        style="cursor: pointer"
                                        data-keyword="${result.data[i].brand_name + result.data[i].brand_description + result.data[i].barcode + result.data[i].sku_code + result.data[i].plu_code}
                                        data-id-barang-passable="${result.data[i].id}"
                                    >
                                        <div class="d-flex justify-content-center flex-column mr-2">
                                            <div>
                                                <span class="font-size-h6 font-weight-bolder">${result.data[i].brand_name}</span>
                                            </div>
                                            <span>${result.data[i].brand_description}</span>
                                        </div>
                                        <button type="button" class="btn btn-white text-primary">
                                            <i class="fa text-primary fa-angle-right p-0"></i>
                                        </button>
                                    </div>
                                `
                }
                $(".goods_placement").append(target);
            },
            error: function(err) {
                console.log(err.responseText);
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
                $("#unit_barang_tambah").text(" / " + focus.unit_initial);
                $("#tombol_tambah_baru").attr("data-id-barang", focus.id)

                $("#tambah_barang").modal("show");
            },
            error: function(resp) {
                console.log(resp.responseText);
            }
        });
    }

    function delete_baris(id) {
        $("#" + id).remove();
        render_table_number();
        hitung_ulang_all();

        if ($("table#daftar_barang_order tbody").children().length > 0) {
            $("#submitButton").removeAttr("disabled");
        } else {
            $("#submitButton").attr("disabled", "disabled");
        }
    }

    function render_table_number() {
        $("table#daftar_barang_order tbody td:first-child").each(function(index, elem) {
            $(elem).text(index + 1);
        })
        if ($("table#daftar_barang_order tbody th:first-child").length === 0) {
            $("#submitButton").attr("disabled", "disabled");
        } else {
            $("#submitButton").removeAttr("disabled");
        }
    }

    function hitung_ulang_all() {
        var total_price = 0;
        $("table#daftar_barang_order tbody tr").each(function(e) {
            const row_id = $(this).attr("id");
            const row_quantity = $("#jumlah_" + row_id).val();
            const row_price = $("#harga_" + row_id).val();
            const row_discount = $("#diskon_" + row_id).val();
            
            const subtotal = (parseInt(row_quantity) * parseInt(row_price) * (100 - parseInt(row_discount)) / 100);
            total_price += subtotal;
            $("#total_harga_" + row_id).text(numeral(subtotal).format('0,[.]00'));
        });

        const pajak = total_price / 10;
        const finalPrice = total_price * 110 / 100;
        $("#total_harga_order").text(numeral(total_price).format('0,[.]00'));
        $("#tax_price").text(numeral(pajak).format('0,[.]00'));
        $("#total_harga_order_tax").text(numeral(finalPrice).format('0,[.]00'))

        if ($("table#daftar_barang_order tbody").children().length > 0) {
            $("#submitButton").removeAttr("disabled");
        } else {
            $("#submitButton").attr("disabled", "disabled");
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

            hitung_ulang_all()
        } else {
            // ambil info barang dengan ajax
            $.ajax({
                url: "<?= base_url("/index.php/api/get_barang/") ?>" + id,
                success: function(response) {
                    let price = parseInt(response.data["default_price"]);;
                    let discount = 0;
                    if (response.data["price_" + index_harga]) {
                        price = parseInt(response.data["price_" + index_harga]);
                        discount = parseInt(response.data["discount_percent_" + index_harga]);
                    }

                    if (isNaN(price)) {
                        price = 0;
                    }

                    if (isNaN(discount)) {
                        discount = 0;
                    }

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
                                .attr("value", data.brand_name + " " + data.brand_description)
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
                                .change(() => hitung_ulang_all())
                            ),

                            // unit barang
                            $(document.createElement("td")).text(data.ratio_flag == 1 ? "Pieces" : data.unit_initial),

                            $(document.createElement("td")).append(
                                $(document.createElement("input"))
                                .attr("type", "number")
                                .addClass("form-control text-right rupiah")
                                .attr("id", "harga_" + data.id)
                                .attr("name", `barang[${data.id}][price]`)
                                .val(price)
                                .attr("min", "1")
                                .change(() => hitung_ulang_all())
                            ),

                            // diskon (TODO)
                            $(document.createElement("td")).attr("style", "width: 90px").append(
                                $(document.createElement("input"))
                                .attr("type", "number")
                                .addClass("form-control text-center")
                                .attr("style", "width: 100%")
                                .attr("id", "diskon_" + data.id)
                                .attr("name", `barang[${data.id}][discount]`)
                                .val(discount)
                                .attr("min", "0")
                                .attr("max", "100")
                                .change(() => hitung_ulang_all()),
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
                    hitung_ulang_all();

                    // tombol submit
                    $("#submitButton").removeAttr("disabled");
                }
            })
        }
    }

    function suggester_me(event, element) {
        const searchtarget = $(element).val().replace(/ /g, '').toLowerCase();
        let total_found = 0;
        let id_barang = 0;
        $('.goods_placement').children('div.align-items-center.justify-content-between.mb-5.text-dark-75.text-hover-primary').each(function() {
            var targetkey = $(this).attr("data-keyword").replace(/ /g, '').toLowerCase();
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

    function confirm_pos_submit() {
        Swal.fire({
            title: "Konfirmasi simpan POS?",
            text: "Anda akan menyimpan POS ini",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Ya, Simpan!"
        }).then(function(result) {
            if (result.value) {
                $("#pos_form").submit()
            }
        })
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