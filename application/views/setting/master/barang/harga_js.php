<script>
    $(document).ready(() => {
        $("#harga_barang_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            columnDefs: [{
                responsivePriority: 1,
                targets: 0
            }, ],
            ajax: "<?= base_url("/index.php/api/barang") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'brand_description'
                },
                {
                    data: 'default_price',
                    render: function(data, type, row, meta) {
                        var toreturn = $(document.createElement("div")).append(
                            $(document.createElement("input"))
                            .attr("type", "number")
                            .addClass("form-control text-right")
                            .attr("style", "min-width: 120px")
                            .attr("value", data)
                            .attr("onchange", `ubah_data(0, ${row.id}, this)`)
                            .attr("min", "1"),
                        )[0].outerHTML;
                        return toreturn;
                    }
                },
                <?php for ($i = 1; $i <= 5; $i++) { ?> {
                        data: 'price_<?= $i ?>',
                        render: function(data, type, row, meta) {
                            var toreturn = $(document.createElement("div")).append(
                                $(document.createElement("input"))
                                .attr("type", "number")
                                .addClass("form-control text-right")
                                .attr("style", "min-width: 120px")
                                .attr("value", data)
                                .attr("onchange", `ubah_data(<?= $i ?>, ${row.id}, this)`)
                                .attr("min", "1"),

                                $(document.createElement("input"))
                                .attr("type", "hidden")
                                .attr("id", "1_" + row.id)
                                .attr("name", `barang[${meta.row}][price_1]`)
                                .attr("min", "1")
                            )[0].outerHTML;
                            return toreturn;
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
            url: "<?= base_url("/index.php/api/ubah_harga_barang") ?>",
            method: "POST",
            data: {
                id: id,
                price_index: index_harga,
                price: element.value
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