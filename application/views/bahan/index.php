<?php
												        $flash_data = $this->session->flashdata('pesan');
												        if (!empty($flash_data)) {
												            echo $flash_data;
												        }
												        ?>
                            
							<div class="table-responsive">
								<table class="table table-bordered" id="table-data" width="100%" cellspacing="0">
									            <thead>
									                <tr>
									                    <th>No</th>
									                    <th>Nama Bahan</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
									                </tr>
									            </thead>
									            <tbody>
									            </tbody>
										
									            <tfoot>
									                <tr>
									                    <th>No</th>
									                    <th>Nama Bahan</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
									                </tr>
									            </tfoot>
													</table>
