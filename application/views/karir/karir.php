

<main>
		<h1 class="mb-4">Carrier</h1>


	<div class="d-flex justify-content-between flex-wrap mt-5">
		<button type="button" class="btn  rounded-pill btn-flex gradient-btn mt-3" data-bs-toggle="modal"
				data-bs-target="#addProduct">
			<i class="bi bi-plus-circle"></i> Add Job Vacancy
		</button>
	</div>

	<div class=" mt-12  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
		<div class="row g-3 align-items-center mt-4">
			<div class="col-12 col-md-auto">
				<label class="form-label">Date:</label>
				<select id="filterSelect" class="form-select form-select-sm">
					<option value="">All</option>
					<option value="today">Today</option>
					<option value="yesterday">Yesterday</option>
					<option value="this_week">This Week</option>
					<option value="last_week">Last Week</option>
					<option value="this_month" >This Month</option>
					<option value="last_month">Last Month</option>
					<option value="this_year">This Year</option>
					<option value="last_year">Last Year</option>
					<option value="custom">Custom Range</option>
				</select>
			</div>

			<div class="col-12 col-md-auto">
				<label class="form-label">Product:</label>
				<select id="filterProduct" class="form-select form-select-sm">
					<option value="" selected>-</option>
					<?php foreach($product as $products): ?>
						<option value="<?= $products['id_product'] ?>"><?= $products['name_product'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		</div>

		<div class="table-responsive mt-4">
			<table id="job_vacancy_table" class="table table-bordered table-striped w-100">
				<thead class="table-primary">
				<tr>
					<th>Mulai</th>
					<th>Berakhir</th>
					<th>Product</th>
					<th>Posisi</th>
					<th>Lokasi</th>
					<th>Gaji</th>
					<th>Kualifikasi</th>
					<th>Benefit</th>
					<th>Jam Kerja</th>
					<th>Whatsapp</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal untuk Custom Date -->
	<div id="customDateModal" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Select Date Range</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="customDateForm">
						<div class="mb-3">
							<label for="startDate" class="form-label">Start Date</label>
							<input type="date" id="startDate" name="start_date" class="form-control">
						</div>
						<div class="mb-3">
							<label for="endDate" class="form-label">End Date</label>
							<input type="date" id="endDate" name="end_date" class="form-control">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="applyCustomDate">Apply</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Add Product -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add Job Vacancy</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
						 aria-label="Close">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="ti ti-minus"></i>
                            </span>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('karir/karir/add_karir') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Mulai Posting</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="mulai_posting" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Akhir Posting</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date"  name="akhir_posting" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Product</span>
						</div>
						<div class="fv-row mb-8">
							<select id="product" class="form-select" aria-label="Default select example" name="id_product">
								<option selected>-Pilih product-</option>
								<?php foreach ($product as $ctg): ?>
									<option value="<?= $ctg['id_product'] ?>"><?= $ctg['name_product'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Posisi</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="posisi" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Lokasi Penempatan</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="lokasi_penempatan" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Gaji</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="gaji" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Kualifikasi</span>
						</div>
						<div class="fv-row mb-8">
                            <textarea type="text" placeholder="kualifikasi" name="kualifikasi" autocomplete="off" class="form-control bg-transparent" style="height: 200px"></textarea>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Benefit</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" placeholder="benefit" name="benefit" autocomplete="off" class="form-control bg-transparent"  style="height: 200px"></textarea>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Jam Kerja</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="jam_kerja" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Whatsapp</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="whatsapp" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Email</span>
						</div>
						<div class="fv-row mb-8">
							<input type="email"  name="email" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
                                <span class="indicator-label">
                                    Add Job Vacancy
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
	<div class="modal fade" id="editJobVacancyModal" tabindex="-1">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit Job Vacancy</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
						 aria-label="Close" tabindex="-1" aria-labelledby="editFinanceModalLabel" aria-hidden="true">
                        <span class="svg-icon svg-icon-2">
                            <i class="ti ti-minus"></i>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="editJobVacancyForm" enctype="multipart/form-data">
						<input type="hidden" name="id_karir" id="edit_id_karir">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Mulai Posting</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="mulai_posting" id="edit_mulai_posting" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Akhir Posting</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date"  name="akhir_posting" id="edit_akhir_posting" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Product</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" id="edit_id_product" name="id_product">
								<option selected>-Pilih product-</option>
								<?php foreach ($product as $ctg): ?>
									<option value="<?= $ctg['id_product'] ?>"><?= $ctg['name_product'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Posisi</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  id="edit_posisi" name="posisi" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Lokasi Penempatan</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="lokasi_penempatan" id="edit_lokasi_penempatan" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Gaji</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="gaji" autocomplete="off" id="edit_gaji" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Kualifikasi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" placeholder="kualifikasi" id="edit_kualifikasi" name="kualifikasi" autocomplete="off" class="form-control bg-transparent" style="height: 150px"></textarea>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Benefit</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" placeholder="benefit" id="edit_benefit" name="benefit" autocomplete="off" class="form-control bg-transparent"  style="height: 150px"></textarea>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Jam Kerja</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="jam_kerja" id="edit_jam_kerja" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Whatsapp</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="whatsapp" id="edit_whatsapp" autocomplete="off" class="form-control bg-transparent"" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Email</span>
						</div>
						<div class="fv-row mb-8">
							<input type="email"  name="email" autocomplete="off" id="edit_email" class="form-control bg-transparent"" />
						</div>
						<div class="d-grid mb-10 mt-10">
							<button type="submit" class="btn btn-primary"><span class="indicator-label">
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
		let base = '<?= base_url()?>';
		const base_url = $('meta[name="base_url"]').attr('content');

		let table;
		let option = '';
		let startDate = '';
		let endDate = '';

		let product = '';









		//KATEGORY TO ACCOUNT



		// ------------EDIT FINANCE
		function editKarirBtn(element) {
			let $element = $(element);

			$("#edit_id_karir").val($element.data('id_karir'));
			$("#edit_mulai_posting").val($element.data('mulai_posting'));
			$("#edit_akhir_posting").val($element.data('akhir_posting'));
			$("#edit_whatsapp").val($element.data('whatsapp'));
			$("#edit_id_product").val($element.data('id_product'));
			$("#edit_posisi").val($element.data('posisi'));
			$("#edit_lokasi_penempatan").val($element.data('lokasi_penempatan'));
			$("#edit_gaji").val($element.data('gaji'));
			$("#edit_kualifikasi").val($element.data('kualifikasi'));
			$("#edit_benefit").val($element.data('benefit'));
			$("#edit_jam_kerja").val($element.data('jam_kerja'));
			$("#edit_email").val($element.data('email'));



			//console.log($element.data('mulai_posting'));
			$("#editJobVacancyModal").modal("show");
		}


		$(document).ready(function() {
			const base_url = $('meta[name="base_url"]').attr('content');

			$("#editJobVacancyForm").on("submit", function(e) {
				e.preventDefault();
				$.ajax({
					url: base_url + "karir/karir/update",
					type: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function(response) {
						if (response.status) {
							Swal.fire({
								icon: "success",
								title: "Berhasil",
								text: response.message,
								timer: 1500,
								showConfirmButton: false
							}).then(() => location.reload());
						} else {
							Swal.fire({
								icon: "error",
								title: "Gagal",
								text: response.message
							});
						}
					},
					error: function(xhr, status, error) {
						Swal.fire({
							icon: "error",
							title: "Error",
							text: "Terjadi kesalahan, silahkan coba lagi."
						});
					}
				});
			});
		});


		//------------DELETE FINANCE
		function handleDeleteKarirButton(id) {
			console.log(id)
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Data yang dihapus tidak dapat dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, Hapus',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {
					const base_url = $('meta[name="base_url"]').attr('content');
					$.ajax({
						url: base_url + 'karir/karir/delete',
						type: 'POST',
						data: {
							id: id
						},
						success: function(response) {
							var res = JSON.parse(response);
							if (res.status) {
								swallMssg_s(res.message, false, 1500)
									.then(() => {
										location.reload();
									});
							} else {
								swallMssg_e(res.message, true, 0);
							}
						},
						error: function(xhr, status, error) {
							Swal.fire(
								'Kesalahan!',
								'Terjadi kesalahan: Silakan coba lagi.',
								'error'
							);
						},
					});
				}
			});
		}





		//-----------------------DATATABLE
		//--------TEST FILTER

		function callDT() {
			table = $('#job_vacancy_table').DataTable({
				responsive: false,
				autoWidth: false,
				processing: true,
				serverSide: true,
				order: [],
				ajax: {
					url: base + 'karir/karir/dtSideServer',
					type: "POST",
					data: function (d) {
						d.option = option;
						d.startDate = startDate;
						d.endDate = endDate;
						d.product = product;

					},
				},
				dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
				columnDefs: [
					{ targets: "_all", orderable: false },
					{ targets: 0, className: "text-start" },
				],
			});
		}

		callDT();

		// ---------- FILTER DATE
		$('#filterSelect').on('change', function() {
			option = $(this).val();

			if (option === 'custom') {
				$('#customDateModal').modal('show');
			} else {
				table.ajax.reload();

			}


		});


		$('#applyCustomDate').on('click', function() {
			startDate = $('#startDate').val();
			endDate = $('#endDate').val();

			if (!startDate || !endDate) {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: "Masukan tanggal dengan benar"
				});
				return;
			}

			$('#customDateModal').modal('hide');
			option = 'custom';
			table.ajax.reload();
			updateCards(option, startDate, endDate);
		});



		//------------ FILTER PRODUCT
		$('#filterProduct').on('change', function() {
			product = $(this).val();
			table.ajax.reload();
		});





	</script>

</main>
