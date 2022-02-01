<?php echo form_open($form_action); ?>
<!-- start page content -->
<div class="row">
    <div class="col-md-12">
        <div class="tab-content">
            <div class="tab-pane active fontawesome-demo" id="tab1">
                <div class="row">
                    <div class="col-md-12">
                            <div class="card-body ">
                                <!--PAGE CONTENT BEGINS-->
                                <form class="form-horizontal">
                                    <?php echo isset($pesan) ? $pesan : ''; ?>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Nama Unsur
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="nama_unsur" data-required="1" placeholder="Nama Unsur..." value="<?= set_value('nama_unsur', isset($form_value['nama_unsur']) ? $form_value['nama_unsur'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('nama_unsur', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Kode Unsur
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="kode_unsur" data-required="1" placeholder="Masukkan Kode Unsur ..." value="<?= set_value('kode_unsur', isset($form_value['kode_unsur']) ? $form_value['kode_unsur'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('kode_unsur', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Keterangan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="keterangan" data-required="1" placeholder="Keterangan..." value="<?= set_value('keterangan', isset($form_value['keterangan']) ? $form_value['keterangan'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('keterangan', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="offset-md-3 col-md-9">
                                                    <input name="submit" type="submit" value="Submit" class="btn btn-success m-r-20">
                                                    <button class="btn btn-danger" type="reset" value="reset">
                                                        Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>