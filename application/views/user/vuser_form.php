<?php echo form_open($form_action); ?>
<!-- start page content -->
<div class="row">
    <div class="col-md-12">
        <div class="tab-content">
            <div class="tab-pane active fontawesome-demo" id="tab1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-red">
                            <div class="card-body ">
                                <!--PAGE CONTENT BEGINS-->
                                <form class="form-horizontal">
                                    <?php echo isset($pesan) ? $pesan : ''; ?>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Username
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="username" data-required="1" placeholder="Username..." value="<?= set_value('username', isset($form_value['username']) ? $form_value['username'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('username', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Nama Lengkap
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="nama_lengkap" data-required="1" placeholder="Masukkan Nama Lengkap ..." value="<?= set_value('nama_lengkap', isset($form_value['nama_lengkap']) ? $form_value['nama_lengkap'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('nama_lengkap', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Password
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                <input type="text" name="password" data-required="1" placeholder="Password..." value="<?= set_value('password', isset($form_value['password']) ? $form_value['password'] : '') ?>" class="form-control input-height" />
                                                <span class="help-inline"><?php echo form_error('password', '<div class="help-inline red">', '</div>'); ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Grup
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-5">
                                                   <?= form_dropdown('grup',$drgrup,$drgrups,'class ="form-control input-height"')?>
                                                <span class="help-inline"><?php echo form_error('grup', '<div class="help-inline red">', '</div>'); ?></span>
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
</div>