<?php
												        $flash_data = $this->session->flashdata('pesan');
												        if (!empty($flash_data)) {
												            echo $flash_data;
												        }
												        ?>
												        <?= anchor('tambahjenis_barang', '<button class="btn btn-info"><i class="icon-plus  bigger-125"></i><b> Tambah Data Jenis Barang</b></button>') ?>
												        <div class="space-10"></div>
                            
							<div class="table-responsive">
								<table class="table table-bordered" id="table-data" width="100%" cellspacing="0">
									            <thead>
									                <tr>
									                    <th>No</th>
									                    <th>Jenis Barang</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
									                </tr>
									            </thead>
									            <tbody>
									            </tbody>
										
									            <tfoot>
									                <tr>
									                    <th>No</th>
									                    <th>Jenis Barang</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
									                </tr>
									            </tfoot>
													</table>
