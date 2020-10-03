<script>
    $(document).ready(() => {
        $("#diskon_barang_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            columnDefs: [{
                responsivePriority: 1,
                targets: 0
            }, ],
            ajax: "<?= base_url("/index.php/flowstream_api/v1/goods/barang_cabang_diskon_only/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'brand_name',
                    render: function(data, type, row, meta) {
                        return `
                        <div>
                            <span class="font-size-h6 font-weight-bold">${data}</span>
                        </div>
                        <div>
                            <span>${row.brand_description}</span>
                        </div>
                        <div>
                            <small>${row.sku_code}</small>
                        </div>
                        `;
                    }
                },
                {
                    data: 'default_discount',
                    render: function(data, type, row, meta) {
                        var toreturn = $(document.createElement("div")).append(
                            $(document.createElement("input"))
                            .attr("type", "number")
                            .addClass("form-control text-right")
                            .attr("style", "min-width: 120px")
                            .attr("value", data ? data : 0)
                            .attr("onchange", `ubah_data(0, ${row.id}, this)`)
                            .attr("min", "1"),
                        )[0].outerHTML;
                        return toreturn;
                    }
                },
                <?php for ($i = 1; $i <= 5; $i++) { ?> {
                        data: 'discount_<?= $i ?>',
                        render: function(data, type, row, meta) {
                            return `
                            <div>
                                <input type="number" class="form-control text-right" style="min-width: 120px" value="${data ? data : 0}" onchange="ubah_data(<?= $i ?>, ${row.id}, this)" min="0" max="100">
                            </div>
                            `;
                        }
                    },
                <?php } ?>
            ]
        })

        $('.select2').select2({
            width: '100%'
        });

        $("form").submit(function() {
            $("input").each(function(index, obj) {
                if ($(obj).val() == "") {
                    $(obj).remove();
                }
            });
        });
    })

    function ubah_data(index_harga, id, element) {
        $.ajax({
            url: "<?= base_url("/index.php/flowstream_api/v1/goods/ubah_diskon_barang") ?>",
            method: "POST",
            data: {
                id: id,
                price_index: index_harga,
                discount: element.value
            },
            success: function(response) {
                $info = $(document.createElement("div")).css("position", "absolute").text("Saved!").css("transform", "translate(5px, 5px)").css("display", "none");
                $(element).parent().prepend($info);
                $info.fadeIn().delay(500).fadeOut("slow", function() {
                    $info.remove();
                });
            },
            error: function(e) {
                console.log(e.responseText);
            }
        })
    }
</script>