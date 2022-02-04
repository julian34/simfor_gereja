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
                                            <label class="control-label col-md-3">NIK
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="nik" data-required="1" placeholder="NIK..." value="<?= set_value('nik', isset($form_value['nik']) ? $form_value['nik'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('nik', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Nama Jemaat
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="nama_jemaat" data-required="1" placeholder="Nama Jemaat..." value="<?= set_value('nama_jemaat', isset($form_value['nama_jemaat']) ? $form_value['nama_jemaat'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('nama_jemaat', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Jenis Kelamin
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="jenis_kelamin" data-required="1" placeholder="Jenis Kelamin..." value="<?= set_value('jenis_kelamin', isset($form_value['jenis_kelamin']) ? $form_value['jenis_kelamin'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('jenis_kelamin', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Tempat Lahir
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="tempat_lahir" data-required="1" placeholder="Tempat Lahir..." value="<?= set_value('tempat_lahir', isset($form_value['tempat_lahir']) ? $form_value['tempat_lahir'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('tempat_lahir', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Tanggal Lahir
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="tanggal_lahir" data-required="1" placeholder="Tanggal Lahir..." value="<?= set_value('tanggal_lahir', isset($form_value['tanggal_lahir']) ? $form_value['tanggal_lahir'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('tanggal_lahir', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>
                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Alamat
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="alamat" data-required="1" placeholder="Alamat..." value="<?= set_value('alamat', isset($form_value['alamat']) ? $form_value['alamat'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('alamat', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                        <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Wijk
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="id_wijk" data-required="1" placeholder="Wijk..." value="<?= set_value('id_wijk', isset($form_value['id_wijk']) ? $form_value['id_wijk'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('id_wijk', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">KSP
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="id_ksp" data-required="1" placeholder="KSP..." value="<?= set_value('id_ksp', isset($form_value['id_ksp']) ? $form_value['id_ksp'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('id_ksp', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Unsur
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="id_unsur" data-required="1" placeholder="Unsur..." value="<?= set_value('id_unsur', isset($form_value['id_unsur']) ? $form_value['id_unsur'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('id_unsur', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Status Baptis
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="status_baptis" data-required="1" placeholder="Status Baptis..." value="<?= set_value('status_baptis', isset($form_value['status_baptis']) ? $form_value['status_baptis'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('status_baptis', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Status SIDI
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="status_sidi" data-required="1" placeholder="Status SIDI..." value="<?= set_value('status_sidi', isset($form_value['status_sidi']) ? $form_value['status_sidi'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('status_sidi', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Status Nikah
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="status_nikah" data-required="1" placeholder="Status Nikah..." value="<?= set_value('status_nikah', isset($form_value['status_nikah']) ? $form_value['status_nikah'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('status_nikah', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                    
                                    <div class="form-body">
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