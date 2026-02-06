


<style>




	#products_table {
		width: 100% !important;
	}


	#products_table thead th,
	#products_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}


</style>

<main>
	<h1>Partner</h1>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Partner
	</button>

	<div class="mt-6">
		<div class=" mt-12  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
			<div style="overflow-x: auto; width: 100%;">
				<table id="products_table" class="table table-bordered table-striped" style="width:100%">
					<thead class="table-primary">
					<?php $no = 1 ?>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Deskripsi</th>
						<th>Url</th>
						<th>Logo</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($list_partner as $product): ?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $product['name_partner']; ?></td>
							<td><?= $product['description']; ?></td>
							<td><?php if($product['url']):?>
									<a href="<?= $product['url']; ?>" target="_blank">
										<button class="btn btn-light btn-sm">
											<i class="ti ti-link"></i>
										</button>
									</a>
								<?php else:?>

								<?php endif; ?>
							</td>
							<td>
								<img src="<?= base_url('uploads/partner/' . $product['image_partner']); ?>" alt="Logo" width="50" style="cursor: pointer;" onclick="showImageModal('<?= base_url('uploads/partner/' . $product['image_partner']); ?>')">
							</td>
							<td>
								<button
									class="btn gradient-btn-edit btn-sm mb-2 rounded-pill btn-edit" style="width : 70px"
									data-id="<?= $product['id_partner']; ?>"
									data-name="<?= $product['name_partner']; ?>"
									data-description="<?= $product['description']; ?>"
									data-url="<?= $product['url']; ?>"
									data-logo="<?= $product['image_partner']; ?>">
									EDIT
								</button>
								<button class="btn gradient-btn-delete mb-2 btn-sm rounded-pill btn-delete-product-homepage" data-id_product="<?= $product['id_partner']; ?>" style="width : 70px">
									DELETE
								</button>
							</td>
						</tr>
						<?php $no++?>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Add Partner -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add Partner</h3>

					<!--begin::Close-->
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
					</div>
					<!--end::Close-->
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/Partner/add_partner') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Logo</span>
						</div>
						<div class="fv-row mb-8">
							<input type="file" placeholder="Logo" name="logo" autocomplete="off" class="form-control bg-transparent" required/>
						</div>
						<div class="fv-row mb-8">
							<input type="text" placeholder="Name" name="name" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" placeholder="Description" name="description" autocomplete="off" class="form-control bg-transparent"></textarea>
						</div>
						<div class="fv-row mb-8">
							<input type="text" placeholder="url" name="url" autocomplete="off" class="form-control bg-transparent"/>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add Partner
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
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit Partner</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
					</div>

				</div>

				<div class="modal-body">
					<form class="form w-100" id="editProductHomePageForm">
						<input type="hidden" id="edit_id" name="id_partner">
						<div class="mb-3">
							<label for="logo" class="form-label">Logo</label>
							<input type="file" class="form-control" id="logo" name="logo">
						</div>
						<div class="form-group mb-5">
							<label for="edit_name">Partner Name</label>
							<input type="text" class="form-control" id="edit_name" name="name" required>
						</div>
						<div class="form-group mb-5">
							<label for="edit_description">Description</label>
							<textarea class="form-control" id="edit_description" name="description" required></textarea>
						</div>
						<div class="form-group">
							<label for="edit_url">URL</label>
							<input type="text" class="form-control" id="edit_url" name="url">
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


	<!-- Modal untuk gambar -->
	<div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); justify-content: center; align-items: center; z-index: 1000;">
		<span style="position: absolute; top: 20px; right: 30px; color: white; font-size: 30px; cursor: pointer;" onclick="closeImageModal()">×</span>
		<img id="modalImage" src="" alt="Preview" style="max-width: 90%; max-height: 90%;">
	</div>

	<script>
		var base_urls = $('meta[name="base_url"]').attr('content');
		$('#products_table').DataTable({
			dom: "<'row'<'col-sm-12 col-md-6 d-flex align-items-center'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'f>>" +
				"tr" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
		});


		function showImageModal(imageSrc) {
			document.getElementById('modalImage').src = imageSrc;
			document.getElementById('imageModal').style.display = 'flex';
		}

		function closeImageModal() {
			document.getElementById('imageModal').style.display = 'none';
		}


		//edit
		$("#editProductHomePageForm").on("submit", function (e) {
			e.preventDefault();

			var formElement = this;
			var formData = new FormData(formElement);

			$.ajax({
				url: base_urls +"admin/Partner/update",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
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


		//delete
		$(document).ready(function () {
			var base_url = $('meta[name="base_url"]').attr('content');

			$(".btn-delete-product-homepage").on("click", function () {
				var id_product = $(this).data("id_product");

				Swal.fire({
					title: "Apakah Anda yakin?",
					text: "Produk ini akan dihapus secara permanen!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#d33",
					cancelButtonColor: "#3085d6",
					confirmButtonText: "Ya, hapus!",
					cancelButtonText: "Batal"
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: base_url + "admin/Partner/delete",
							type: "POST",
							data: { id_product_homepage: id_product },
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
								swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product '+error , true, 0).
								then(() =>  {
									location.reload();
								});
							}
						});
					}
				});
			});
		});




	</script>
</main>
