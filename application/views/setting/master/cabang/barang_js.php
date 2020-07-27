<script>
    console.log("<?= base_url("/index.php/api/barang_cabang/$data_branch->id") ?>");
    $(document).ready(() => {
        $("#master_barang_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            iDisplayLength: 50,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: -1
                },
                {
                    targets: -1,
                    orderable: false,
                },
            ],
            ajax: "<?= base_url("/index.php/api/barang_cabang/$data_branch->id") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'brand_name',
                    render: function(data, type, row, meta) {
                        return `<div class="font-weight-bold">${data} </div><span>${row.brand_description}</span>`
                    }
                },
                {
                    data: "barcode"
                },
                {
                    data: "sku_code"
                },
                {
                    data: "plu_code"
                },
                {
                    data: "division",
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${data} <br> (${row.sub_division})</div>`
                    }
                },
                {
                    data: "category",
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${data} <br> (${row.sub_category})</div>`
                    }
                },
                {
                    data: "package"
                },
                {
                    data: "color"
                },
                {
                    data: "unit"
                },
                {
                    data: "hpp"
                },
                {
                    data: "quantity"
                },
                {
                    data: "tax"
                },
                {
                    data: "id",
                    className: "text-center",
                    createdCell: function(td) {
                        $(td).attr("nowrap", "nowrap");
                    },
                    render: function(data, type, row, meta) {
                        return `
                            <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit_barang(
                                '${row.id}',
                                '${row.brand_name}',
                                '${row.brand_description}',
                                '${row.barcode}',
                                '${row.sku_code}',
                                '${row.plu_code}',
                                '${row.division_id}',
                                '${row.sub_division_id}',
                                '${row.category_id}',
                                '${row.sub_category_id}',
                                '${row.package_id}',
                                '${row.color_id}',
                                '${row.unit_id}',
                                '${row.hpp}',
                                '${row.quantity}',
                                '${row.tax}',
                                '${row.ratio_flag}',
                                '${row.rekening_no}'
                                )">
                                <i class="flaticon2-pen"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="konfirmasi_hapus(${row.id}, '${row.brand_description}')">
                                <i class="flaticon2-trash"></i>
                            </button>
                        `
                    }
                }
            ]
        })

        $('.select2').select2({
            width: '100%'
        });

        $('#delete_modal').on('hidden.bs.modal', function() {
            $("#id_hapus").val("");
            $("#brand_description_hapus").text("");
        })
    })

    function konfirmasi_hapus(id, brand_description) {
        $("#id_hapus").val(id);
        $("#brand_description_hapus").text(brand_description);
        $("#delete_modal").modal('show');
    }

    function edit_barang(
        id,
        brand_name,
        brand_description,
        barcode,
        sku_code,
        plu_code,
        division,
        sub_division,
        category,
        sub_category,
        package,
        color,
        unit,
        hpp,
        quantity,
        tax,
        ratio_flag,
        rekening_no
    ) {
        $("#id_barang_edit").val(id)
        $("#brand_name_edit").val(brand_name)
        $("#brand_description_edit").val(brand_description)
        $("#barcode_edit").val(barcode)
        $("#sku_edit").val(sku_code)
        $("#plu_edit").val(plu_code)
        $("#division_edit").val(division)
        $("#sub_division_edit").val(sub_division)
        $("#category_edit").val(category)
        $("#sub_category_edit").val(sub_category)
        $("#package_edit").val(package)
        $("#color_edit").val(color)
        $("#unit_edit").val(unit)
        $("#quantity_edit").val(quantity)
        $("#tax_edit").val(tax)
        $("#ratio_flag_edit").val(ratio_flag)
        $("#rekening_no_edit").val(rekening_no)

        $('.select2').trigger('change');
        $("#edit_barang").modal('show');
    }
</script>