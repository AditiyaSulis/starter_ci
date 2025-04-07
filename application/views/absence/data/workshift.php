<main>
	<h1>Workshift</h1>

	<div class="row mt-3">
		<div class="col-md-12">
			<button type="button" class="btn gradient-btn rounded-pill mt-6 mb-6" data-bs-toggle="modal" data-bs-target="#addWorkshift">
				<i class="bi bi-plus-circle"></i>
				Add Workshift
			</button>

			<div class=" mt-2  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
				<div class="table-responsive">
					<table id="workshift_table" class="table table-bordered table-striped" style="width:100%">
						<thead>
						<?php $no = 1 ?>
						<tr>
							<th>No</th>
							<th>Code</th>
							<th>Name</th>
							<th>Clock in</th>
							<th>Clock Out</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($workshift as $shift): ?>
							<tr>
								<td><?= $no; ?></td>
								<td><?= $shift['code_workshift']; ?></td>
								<td><?= $shift['name_workshift']; ?></td>
								<td><?= $shift['clock_in']; ?></td>
								<td><?= $shift['clock_out']; ?></td>
								<td><?= $shift['description']; ?></td>
								<td>
									<a href="javascript:void(0)" onclick="editWorkshiftButton(this)" class="btn gradient-btn-edit mb-2 btn-sm rounded-pill btn-edit-shift" style="width : 70px"
									   data-id_workshift="<?= $shift['id_workshift']; ?>"
									   data-code_workshift="<?= $shift['code_workshift']; ?>"
									   data-name_workshift="<?= $shift['name_workshift']; ?>"
									   data-clock_in="<?= $shift['clock_in']; ?>"
									   data-clock_out="<?= $shift['clock_out']; ?>"
									   data-description="<?= $shift['description']; ?>">
										EDIT
									</a>
									<button  class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-shift" data-id_workshift="<?= $shift['id_workshift']; ?>" style="width : 70px">
										DELETE
									</button>
								</td>
							</tr>
							<?php $no++ ?>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



	<!-- Modal Add Workshift -->
	<div class="modal fade" tabindex="-1" id="addWorkshift">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add Work Shift</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addPositionForm" data-action="<?= site_url('absence/workshift/add_workshift') ?>">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Kode Shift</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" placeholder="Code" name="code_workshift" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Nama</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" placeholder="Name shift" name="name_workshift" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Jam masuk</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" name="clock_in" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Jam keluar</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" name="clock_out" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" name="description" autocomplete="off" class="form-control bg-transparent"></textarea>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_position" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add Work shift
                                            </span>
								<span class="indicator-progress">
                                                     Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Edit Workshift -->
	<div class="modal fade" id="editWorkshiftModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit Work Shift</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
					</div>

				</div>

				<div class="modal-body">
					<form class="form w-100" id="editWorkshiftForm" enctype="multipart/form-data">
						<input type="hidden" name="id_workshift" id="id_workshift">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Code Shift</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" placeholder="Code" name="code_workshift" id="code_workshift" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Name</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" placeholder="Name shift" name="name_workshift" id="name_workshift" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Clock in</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" name="clock_in" id="clock_in" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Clock out</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" name="clock_out" autocomplete="off" id="clock_out" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" name="description" id="description" autocomplete="off" class="form-control bg-transparent"></textarea>
						</div>
							<button type="submit" class="btn btn-primary"><span class="indicator-label">
                                                    Save Changes
                                                </span>
								<span class="indicator-progress">
                                                        Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
							</button>
					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<script>

		$('#workshift_table').DataTable({
			dom: "<'row'<'col-sm-12 col-md-6 d-flex align-items-center'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'f>>" +
				"tr" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
		});

	</script>

</main>



