<script>
    function check_periode() {
        const bulan = $("#bulan").val();
        const tahun = $("#tahun").val();
        if (bulan && tahun) {
            const date = `${tahun}-${bulan}`;

            $.ajax({
                url: "<?= base_url("/index.php/api/preview_tutup_buku/" . $this->session->userdata("branch_id")) ?>",
                data: {
                    periode: date
                },
                success: function(response) {
                    console.log(response.data);
                    var focus = response.data.kode_rekening_saldo;

                    if (focus.length) {
                        var kode_rekening_entries = "";
                        focus.forEach(element => {
                            element.saldo_bulan_lalu = element.saldo_bulan_lalu ? parseInt(element.saldo_bulan_lalu) : 0;
                            element.debit = parseInt(element.debit);
                            element.credit = parseInt(element.credit);
                            kode_rekening_entries += `
                        <tr>
                            <td>${element.acc_code}</td>
                            <td>${element.acc_name == null ? "" : element.acc_name}</td>
                            <td>${element.saldo_bulan_lalu}</td>
                            <td>${element.debit}</td>
                            <td>${element.credit}</td>
                            <td>${element.sum_position == "K" ? element.saldo_bulan_lalu + element.debit - element.credit : element.saldo_bulan_lalu - element.debit + element.credit}</td>
                        </tr>
                        `
                        });

                        focus = response.data.ikhtisar_saldo;
                        var ikhtisar_entries = "";
                        focus.forEach(element => {
                            element.saldo_bulan_lalu = element.saldo_bulan_lalu ? parseInt(element.saldo_bulan_lalu) : 0;
                            element.debit = parseInt(element.debit);
                            element.credit = parseInt(element.credit);
                            ikhtisar_entries += `
                        <tr>
                            <td>${element.acc_code_ikhtisar}</td>
                            <td>${element.acc_name == null ? "" : element.acc_name}</td>
                            <td>${element.saldo_bulan_lalu}</td>
                            <td>${element.debit}</td>
                            <td>${element.credit}</td>
                            <td>${element.sum_position == "K" ? element.saldo_bulan_lalu + element.debit - element.credit : element.saldo_bulan_lalu - element.debit + element.credit}</td>
                        </tr>
                        `
                        });

                        focus = response.data.neraca_saldo;
                        var neraca_entries = "";
                        focus.forEach(element => {
                            element.saldo_bulan_lalu = element.saldo_bulan_lalu ? parseInt(element.saldo_bulan_lalu) : 0;
                            element.debit = parseInt(element.debit);
                            element.credit = parseInt(element.credit);
                            neraca_entries += `
                        <tr>
                            <td>${element.acc_code_neraca}</td>
                            <td>${element.acc_name == null ? "" : element.acc_name}</td>
                            <td>${element.saldo_bulan_lalu}</td>
                            <td>${element.debit}</td>
                            <td>${element.credit}</td>
                            <td>${element.sum_position == "K" ? element.saldo_bulan_lalu + element.debit - element.credit : element.saldo_bulan_lalu - element.debit + element.credit}</td>
                        </tr>
                        `
                        });

                        $("#neraca_saldo_cell").fadeIn();
                        $("#ikhtisar_saldo_cell").fadeIn();
                        $("#kode_rekening_saldo_cell").fadeIn();
                        $("#konfirmasi_cell").fadeIn();

                        $("#konfirmasi_button").attr("href", `<?= base_url("/index.php/api/tutup_buku/") . $this->session->userdata("branch_id") ?>/${date}`)

                        $("#neraca_saldo_list").empty();
                        $("#ikhtisar_saldo_list").empty();
                        $("#kode_rekening_saldo_list").empty();

                        $("#neraca_saldo_list").append(neraca_entries)
                        $("#ikhtisar_saldo_list").append(ikhtisar_entries)
                        $("#kode_rekening_saldo_list").append(kode_rekening_entries)

                        if (response.data.unregistered_jurnal.length) {
                            Swal.fire({
                                title: "Warning",
                                text: "Terdapat jurnal pada periode ini yang belum diregistrasi",
                                icon: "info",
                            });
                        }
                    } else {
                        if (response.data.unregistered_jurnal.length) {
                            Swal.fire({
                                title: "Warning",
                                text: "Terdapat jurnal pada periode ini yang belum diregistrasi",
                                icon: "info",
                            });
                        }
                        Swal.fire({
                            title: "Data tidak ditemukan",
                            text: "Tidak terdapat jurnal periode ini yang dapat dimasukan kedalam tutup buku",
                            icon: "info",
                        });
                    }
                },
                failed: function(err) {
                    alert("terjadi kesalahan");
                    console.log(err.responseText)
                }
            })
        } else {
            Swal.fire({
                title: "Data belum lengkap",
                text: "Silahkan pilih periode dan tahun",
                icon: "info",
            });
        }
    }
</script>