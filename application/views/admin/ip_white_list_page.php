<main>
	<h1>IP White List</h1>

	<div class="row mt-12">
		<div class="col-md-12 mb-4">
			<h4>IP White List</h4>
			<button type="button" class="btn gradient-btn rounded-pill mt-6 mb-6" data-bs-toggle="modal" data-bs-target="#addProduct">
				<i class="bi bi-plus-circle"></i>
				Add IP White List
			</button>

			<div class="table-responsive">
				<table id="division_table" class="table table-bordered table-striped" style="width:100%">
					<thead>
					<?php $no = 1 ?>
					<tr>
						<th>No</th>
						<th>IP White List</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($white_list as $dv): ?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $dv['white_list']; ?></td>
							<td>
								<a href="javascript:void(0)" onclick="editWhiteListButton(this)" class="btn gradient-btn-edit mb-2 btn-sm rounded-pill btn-edit-dv" style="width : 70px"
								   data-id_ip_white_list="<?= $dv['id_ip_white_list']; ?>"
								   data-white_list="<?= $dv['white_list']; ?>">
									EDIT
								</a>
								<button  class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-wl" data-id_ip_white_list="<?= $dv['id_ip_white_list']; ?>" style="width : 70px">
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


	<!-- Modal Add Product -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add IP White List</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/Attendance/add_white_list') ?>">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>White List</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" placeholder="125.xx...." name="white_list" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">
										Add White List
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

	<!-- Modal Edit -->
	<div class="modal fade" id="editWhiteListModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit White List</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
					</div>

				</div>

				<div class="modal-body">
					<form class="form w-100" id="editWhiteListForm" enctype="multipart/form-data">
						<input type="hidden" name="id_ip_white_list" id="id_ip_white_list">
						<div class="mb-3">
							<label for="date_in" class="form-label">White List</label>
							<input type="text" name="white_list" id="white_list" class="form-control">
						</div>
						<div class="d-grid mb-10 mt-10">
							<button type="submit" class="btn btn-primary">
								<span class="indicator-label">
									Save Changes
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




	<script>
		$('#division_table').DataTable();


		function editWhiteListButton(element)
		{
			let $element = $(element);

			$("#id_ip_white_list").val($element.data('id_ip_white_list'));
			$("#white_list").val($element.data('white_list'));

			$("#editWhiteListModal").modal("show");
		}


		$(document).ready(function ()
		{
			var base_url = $('meta[name="base_url"]').attr('content');
			console.log($("#id_ip_white_list").val());

			$("#editWhiteListForm").on("submit", function (e) {
				e.preventDefault();
				$.ajax({
					url: base_url + "absence/Attendance/update",
					type: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function (response) {
						if (response.status) {
							swallMssg_s(response.message, false, 1500)
								.then(() =>  {
									location.reload();
								});
						} else {
							swallMssg_e(response.message, true, 0);
						}
					},
					error: function (xhr, status, error) {
						swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
						then(() =>  {
							location.reload();
						});
					}
				});
			});
		});




		$(document).ready(function () {
			var base_url = $('meta[name="base_url"]').attr('content');

			$(".btn-delete-wl").on("click", function () {
				var id_ip_white_list = $(this).data("id_ip_white_list");

				Swal.fire({
					title: "Apakah Anda yakin?",
					text: "Ip ini akan dihapus secara permanen!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#d33",
					cancelButtonColor: "#3085d6",
					confirmButtonText: "Ya, hapus!",
					cancelButtonText: "Batal"
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: base_url + "absence/Attendance/delete",
							type: "POST",
							data: { id_ip_white_list: id_ip_white_list },
							dataType: "json",
							success: function (response) {
								if (response.status) {
									Swal.fire({
										title: 'Success',
										text: response.message,
										icon: 'success',
										timer: 1500
									}).then(() => location.reload());
								} else {
									Swal.fire({
										title: 'Error',
										text: response.message,
										icon: 'error'
									});
								}
							},
							error: function (xhr, status, error) {
								Swal.fire({
									title: 'Error',
									text: 'Terjadi kesalahan: ' + error,
									icon: 'error'
								}).then(() => location.reload());
							}
						});
					}
				});
			});
		});
	</script>

</main>
