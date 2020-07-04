<script>
    $(document).ready(function() {
        $('#pilih_customer').select2({
            placeholder: "Pilih Customer",
            width: "100%"
        });

        $("#daftar_barang_order").DataTable({
            responsive: true,
            paging_type: 'full_numbers',
            ordering: false,
            columnDefs: [{
                    targets: -2,
                    responsivePriority: 2,
                },
                {
                    targets: -1,
                    responsivePriority: 2,
                },
                {
                    targets: 0,
                    responsivePriority: 2,
                },
                {
                    targets: 2,
                    responsivePriority: 2,
                },
                {
                    targets: 3,
                    responsivePriority: 2,
                },
            ],
            scrollY: "500px",
            scrollCollapse: true,
            paging: false,
            info: false
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

    function change_customer(e) {}

    function delete_baris(id) {
        $subtotal_sebelumnya = parseInt($("#total_harga_" + id).text());
        $total_sebelumnya = parseInt($("#total_harga_order").text());
        $("#total_harga_order").text($total_sebelumnya - $subtotal_sebelumnya);

        $("#" + id).remove();
        render_table_number();
    }

    function render_table_number() {
        $("tbody td:first-child").each(function(index, elem) {
            $(elem).text(index + 1);
        })
        if ($("tbody th:first-child").length === 0) {
            $("input[type=submit]").attr("disabled", "disabled");
        } else {
            $("input[type=submit]").removeAttr("disabled");
        }
    }

    function ubah_jumlah(id) {
        $subtotal_sebelumnya = parseInt($("#total_harga_" + id).text());
        $harga = parseInt($("#harga_" + id).text());
        $jumlah = $("#jumlah_" + id).val();
        $diskon_harga = 1 - (parseFloat($("#diskon_" + id).text()) / 100);

        $subtotal_baru = $harga * $jumlah * $diskon_harga
        $("#total_harga_" + id).text($subtotal_baru);

        $total_sebelumnya = parseInt($("#total_harga_order").text());
        $("#total_harga_order").text($total_sebelumnya + $subtotal_baru - $subtotal_sebelumnya);
    }

    function tambah_barang(id) {
        // TODO: jika sudah ada di tabel, tambahkan jumlahnya 1, lalu fokusin dan kasi animasi
        // ambil info barang dengan ajax
        $.ajax({
            url: "<?= base_url("/index.php/api/get_barang/") ?>" + id,
            success: function(response) {
                $jumlah_baru = $("#jumlah_tambah_baru_" + id).val();
                $subtotal_baru = $jumlah_baru * 100000 * 0.9; // TODO: ganti 1 jadi harga
                const data = response.data;
                $("tbody").append(
                    $(document.createElement("tr")).attr("id", data.id).append(
                        // numbering
                        $(document.createElement("td")).addClass("text-center font-weight-bold"),

                        // kode barang dan id input hidden
                        $(document.createElement("td")).text(data.barcode).append(
                            $(document.createElement("input"))
                            .attr("type", "hidden")
                            .attr("name", data.id)
                            .attr("value", data.id)
                        ),

                        // nama barang
                        $(document.createElement("td")).text(data.name),

                        // jumlah barang
                        $(document.createElement("td")).append(
                            $(document.createElement("input"))
                            .attr("type", "number")
                            .addClass("form-control text-center")
                            .attr("style", "width: 70px")
                            .attr("id", "jumlah_" + data.id)
                            .attr("name", "jumlah_" + data.id)
                            .val($jumlah_baru)
                            .attr("min", "1")
                            .change(() => ubah_jumlah(data.id))
                        ),

                        // unit barang
                        $(document.createElement("td")).text(data.unit),

                        // harga barang (TODO)
                        $(document.createElement("td")).text(100000).addClass("text-right rupiah").attr("id", "harga_" + data.id),

                        // diskon (TODO)
                        $(document.createElement("td")).text("10%").addClass("text-center").attr("id", "diskon_" + data.id),

                        // subtotal
                        $(document.createElement("td")).text($subtotal_baru).addClass("text-right rupiah").attr("id", "total_harga_" + data.id),

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
                $("#total_harga_order").text($total_sebelumnya + $subtotal_baru);
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