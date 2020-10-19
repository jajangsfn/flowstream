<div class="row">
    <div class="col-12">
        <?=$this->session->flashdata('msg');?>
        <div class="card card-custom">
            <div class="card-body">
                <button type="button" name="param" class="btn btn-primary" onclick="get_invoice_format()">
                    Format Nomor Faktur
                </button>
            </div>
        </div>
    </div>
</div>

  

<!-- add/edit -->
<div class="modal fade" id="invoice_format_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengaturan Nomor Faktur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?=base_url()?>index.php/setting/save_invoice_format/" id="invoice_form">
            <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="enabled" class="col-form-label">Gunakan</label>
            <input type="checkbox" name="enabled" class="ml-10" id="enabled" onchange="enable_disable()">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Kode Faktur</label>
            <input type="text" name="invoice_code" class="form-control" id="invoice_code"/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_submit" onclick="save_invoice_format()">Simpan</button>
      </div>
    </div>
  </div>
</div>