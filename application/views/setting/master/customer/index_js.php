<script>
    $(document).ready(() => {
        $("#m_partner_table").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ajax: "<?= base_url("/index.php/api/customer") ?>",
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return `<div class="text-center">${meta.row + 1}</div>`;
                    }
                },
                {
                    data: 'name',
                    responsivePriority: 1
                },
                {
                    data: 'master',
                    responsivePriority: 1
                },
                {
                    data: 'partner_code',
                    responsivePriority: 1
                },
                {
                    data: 'address_1'
                },
                {
                    data: 'address_2'
                },
                {
                    data: 'city',
                    responsivePriority: 1
                },
                {
                    data: 'province',
                    responsivePriority: 1
                },
                {
                    data: 'zip_code'
                },
                {
                    data: 'phone',
                    responsivePriority: 1
                },
                {
                    data: 'fax'
                },
                {
                    data: 'email',
                    responsivePriority: 1
                },
                {
                    data: 'tax_number'
                },
                {
                    data: 'partner_type',
                    responsivePriority: 1
                },
                {
                    data: 'sales_price_level'
                },
                {
                    data: 'tax_address'
                },
                {
                    data: 'id',
                    responsivePriority: -1,
                    render: function(data, type, row, meta) {
                        return `
                        <button type="button" class="btn btn-icon btn-sm btn-light-success" onclick="edit(
                            '${row.id}',
                            '${row.master_code}',
                            '${row.branch_id}',
                            '${row.partner_code}',
                            '${row.name}',
                            '${row.address_1}',
                            '${row.address_2}',
                            '${row.city}',
                            '${row.province}',
                            '${row.zip_code}',
                            '${row.email}',
                            '${row.phone}',
                            '${row.tax_number}',
                            '${row.partner_type}',
                            '${row.sales_price_level}',
                            '${row.tax_address}',
                        )">
                            <i class="flaticon2-pen"></i>
                        </button>
                        <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="delete_trigger(
                            '${row.id}',
                            '${row.name}',
                            '${row.partner_code}'
                        )">
                            <i class="flaticon2-trash"></i>
                        </button>
                        `;
                    },
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).attr('nowrap', 'nowrap').addClass("text-center")
                    }
                },
            ]
        })

        $('.select2').select2({
            width: '100%'
        });
    })

    function edit(
        id,
        master_code,
        branch_id,
        partner_code,
        name,
        address_1,
        address_2,
        city,
        province,
        zip_code,
        email,
        phone,
        tax_number,
        partner_type,
        sales_price_level,
        tax_address,
    ) {
        $("#id_edit").val(id);
        $("#branch_id_edit").val(branch_id);
        $("#email_edit").val(email);
        $("#master_code_edit").val(master_code)
        $("#partner_code_edit").val(partner_code);
        $("#name_edit").val(name);
        $("#address_1_edit").val(address_1);
        $("#address_2_edit").val(address_2);
        $("#city_edit").val(city);
        $("#province_edit").val(province);
        $("#zip_code_edit").val(zip_code);
        $("#phone_edit").val(phone);
        $("#tax_number_edit").val(tax_number);
        $("#partner_type_edit").val(partner_type);
        $("#sales_price_level_edit").val(sales_price_level);
        $("#tax_address_edit").val(tax_address);

        $('.select2').trigger('change');
        $("#edit_m_partner").modal('show');
    }

    function delete_trigger(id, name, code) {
        $("#id_delete").val(id);
        $("#name_delete").text(name);
        $("#code_delete").text(code);

        $("#delete_modal").modal('show');
    }
</script>