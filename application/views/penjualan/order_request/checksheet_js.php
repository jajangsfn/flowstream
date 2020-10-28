<script>
    function nomor_ulang() {
        var counter = 1;
        $("table#daftar_barang_order tbody tr td:first-child").each(function(e) {
            $(this).text(counter++);
        });
    }

    function confirm_pembatalan() {
        Swal.fire({
            title: "Anda yakin?",
            text: "Segala perubahan pada checksheet ini tidak akan tersimpan",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Batalkan Checksheet",
            confirmButtonClass: "btn btn-info",
            cancelButtonText: "Tutup",
            cancelButtonClass: "btn btn-warning"
        }).then(function(result) {
            if (result.value) {
                window.location.href = `<?= base_url("/index.php/penjualan/order_request") ?>`;
            }
        })
    }

    $(document).ready(function() {
        renumber();
    });

    function renumber() {
        let counter = 0;
        $("#checksheet_tablebody tr td:first-child").each(function(index, element) {
            $(this).text(++counter)
        })
    }

    function tambahkan_unavailable(
        goods_id,
        barcode,
        brand_name,
        brand_description,
        sku_code,
        quantity,
        ratio_flag,
        converted_quantity,
        last_quantity,
        unit_initial,
        order_placement,
        unavailable_id
    ) {
        $("#checksheet_tablebody").append(
            `
            <tr id="${goods_id}">
                <td class="text-center font-weight-bold"></td>
                <td class="text-center">
                    <label class="checkbox checkbox-lg">
                        <input type="checkbox" name="barang[${goods_id}][available]" checked='checked' />
                        <span></span>
                        <p class="mb-2 invisible">.</p>
                    </label>
                </td>
                <td>
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <input type="number" name="barang[${goods_id}][order_placement]" style="max-width: 100px" class="form-control text-center" value="${getLastOrderNumber()}" min="1">
                    </div>
                </td>
                <td>
                    <div>${barcode}</div>
                </td>
                <td>
                    ${brand_name} - ${brand_description} (${sku_code})
                </td>
                <td style="width: 70px;" class="text-center">
                    ${quantity}
                </td>
                <td style="width: 70px;" class="text-center">
                    <input type="number" name="barang[${goods_id}][quantity]" class="form-control text-center" value="${parseInt(ratio_flag) == 1 ? converted_quantity * last_quantity : last_quantity}" min="0" step="${parseInt(ratio_flag) == 1 ? converted_quantity : 1}">
                </td>
                <td>
                    ${parseInt(ratio_flag) == 1 ? "pcs" : unit_initial}
                </td>
            </tr>
            `
        )
        $("#" + unavailable_id).remove();
        renumber();
    }

    function getLastOrderNumber() {
        let largest = 1;
        $("#checksheet_tablebody tr td:nth-child(3) div input").each(function(index, element) {
            if (parseInt(
                    $(element).val()
                ) >= largest) {
                largest = parseInt($(element).val()) + 1
            }
        })
        return largest;
    }
</script>