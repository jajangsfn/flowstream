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
                    var focus = response.data.kode_rekening_saldo;

                    if (focus.length) {
                        var kode_rekening_entries = "";
                        focus.forEach(element => {
                            kode_rekening_entries += `
                        <tr>
                            <td>${element.acc_code}</td>
                            <td>${element.acc_name == null ? "" : element.acc_name}</td>
                            <td>${element.debit}</td>
                            <td>${element.credit}</td>
                        </tr>
                        `
                        });

                        focus = response.data.ikhtisar_saldo;
                        var ikhtisar_entries = "";
                        focus.forEach(element => {
                            ikhtisar_entries += `
                        <tr>
                            <td>${element.acc_code_ikhtisar}</td>
                            <td>${element.acc_name == null ? "" : element.acc_name}</td>
                            <td>${element.debit}</td>
                            <td>${element.credit}</td>
                        </tr>
                        `
                        });

                        focus = response.data.neraca_saldo;
                        var neraca_entries = "";
                        focus.forEach(element => {
                            neraca_entries += `
                        <tr>
                            <td>${element.acc_code_neraca}</td>
                            <td>${element.acc_name == null ? "" : element.acc_name}</td>
                            <td>${element.debit}</td>
                            <td>${element.credit}</td>
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