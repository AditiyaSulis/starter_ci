<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- Leaflet Control Geocoder -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


<style>

	#map {
		height: 300px;
		width: 100%;
		min-height: 300px;
		display: block; /* Pastikan tidak tersembunyi */
		visibility: visible; /* Paksa elemen terlihat */
	}

	#mapUpdate {
		height: 300px;
		width: 100%;
		min-height: 300px; /* Pastikan tinggi tidak nol */
	}


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
    <h1>Product</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="bi bi-plus-circle"></i>
        Add Product
    </button>

    <div class="mt-6">
		<div style="overflow-x: auto; width: 100%;">
			<table id="products_table" class="table table-bordered table-striped" style="width:100%">
				<thead class="table-primary">
					<?php $no = 1 ?>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Deskripsi</th>
						<th>Url</th>
						<th>Location</th>
						<th>Visibility</th>
						<th>Logo</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($products as $product): ?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $product['name_product']; ?></td>
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
							<button type="button" class="btn btn-warning btn-sm rounded-pill"
									data-bs-toggle="modal"
									data-bs-target="#updateLocationModal"
									data-id_product="<?= $product['id_product'] ?>"
									data-latitude="<?= $product['latitude'] ?>"
									data-longitude="<?= $product['longitude'] ?>">
								<i class="bi bi-pencil"></i> Edit Lokasi
							</button>
						</td>
						<td><?php if($product['visibility'] == 1):?>
								<button class="btn gradient-btn-active btn-sm rounded-pill btn-visibility" style="width : 90px"
								data-id_product="<?= $product['id_product']; ?>"
								data-visibility="<?= $product['visibility']; ?>">
									<i class="bi bi-eye-fill"></i> Show
								</button>
							<?php else:?>
								<button class="btn gradient-btn-inactive btn-sm rounded-pill btn-visibility" style="width : 90px"
								data-id_product="<?= $product['id_product']; ?>"
								data-visibility="<?= $product['visibility']; ?>">
									<i class="bi bi-eye-slash-fill"></i> Hide
								</button>
							<?php endif; ?>
						</td>
						<td>
							<img src="<?= base_url('uploads/products/compressed/' . $product['logo']); ?>" alt="Logo" width="50" style="cursor: pointer;" onclick="showImageModal('<?= base_url('uploads/products/compressed/' . $product['logo']); ?>')">
						</td>
						<td>
							<button
								class="btn gradient-btn-edit btn-sm mb-2 rounded-pill btn-edit" style="width : 70px"
								data-id="<?= $product['id_product']; ?>"
								data-name="<?= $product['name_product']; ?>"
								data-description="<?= $product['description']; ?>"
								data-url="<?= $product['url']; ?>"
								data-logo="<?= $product['logo']; ?>">
								EDIT
							</button>
							<button class="btn gradient-btn-delete mb-2 btn-sm rounded-pill btn-delete-product" data-id_product="<?= $product['id_product']; ?>" style="width : 70px">
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

    <!-- Modal Add Product -->
    <div class="modal fade" tabindex="-1" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Product</h3>

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
                            <form class="form w-100" id="addproducts" data-action="<?= site_url('admin/product/add_products') ?>" enctype="multipart/form-data">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Logo</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="file" placeholder="Logo" name="logo" autocomplete="off" class="form-control bg-transparent" required/> 
                                </div>
								<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
									<span>Lokasi</span>
								</div>
								<div class="fv-row mb-8">
									<div id="map" style="height: 300px; width: 100%;"></div>
								</div>
								<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
									<span>Latitude</span>
								</div>
								<div class="fv-row mb-8">
									<input type="text" id="latitude" name="latitude" autocomplete="off" class="form-control bg-transparent" readonly/>
								</div>
								<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
									<span>Longitude</span>
								</div>
								<div class="fv-row mb-8">
									<input type="text" id="longitude" name="longitude" autocomplete="off" class="form-control bg-transparent" readonly/>
								</div>

                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Name" name="name_product" autocomplete="off" class="form-control bg-transparent"/> 
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
                                                    Add Product
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
                    <h3 class="modal-title">Edit Product</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                    </div>

                </div>

                <div class="modal-body">
                            <form class="form w-100" id="editProductForm">
                                <input type="hidden" id="edit_id" name="id_product">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </div>
                                <div class="form-group mb-5">
                                    <label for="edit_name">Product Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name_product" required>
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


	<!-- Modal Update Location -->
	<div class="modal fade" id="updateLocationModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Location</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
					</div>

				</div>

				<div class="modal-body">
					<form class="form w-100" id="updateLocationForm">
						<input type="hidden" id="edit_id_map" name="id_product">
						<div class="fv-row mb-8">
							<label class="text-gray-900 fw-bolder">Lokasi</label>
							<div id="mapUpdate" style="height: 300px; width: 100%;"></div>
						</div>
						<div class="fv-row mb-8">
							<label class="text-gray-900 fw-bolder">Latitude</label>
							<input type="text" id="latitude_update" name="latitude" class="form-control bg-transparent" readonly>
						</div>
						<div class="fv-row mb-8">
							<label class="text-gray-900 fw-bolder">Longitude</label>
							<input type="text" id="longitude_update" name="longitude" class="form-control bg-transparent" readonly>
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


    <!-- MODAL SET VISIBILITY -->
    <div class="modal fade" tabindex="-1" id="setVisibilityModal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Set Visibility</h4>

          
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
      
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="setVisibilityForm" enctype="multipart/form-data">
                            <input type="hidden" id="id_product_visibility" name="id_product">   
                            <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" id="visibility" name="visibility">
                                        <option value="1">Show</option>
                                        <option value="0">Hide</option>
                                    </select>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Save changes
                                            </span>
                                            <span class="indicator-progress">
                                                     Please wait...    
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                    </button>
                                </div>
                            </form>
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

		//------------------MAP
		var map;
		var marker;

		// add location
		$(document).ready(function () {
			$("#addproducts").on("submit", function (e) {
				e.preventDefault();

				var formElement = this;
				var formData = new FormData(formElement);

				$("#submit_product").prop("disabled", true);

				console.log("🚀 Data yang dikirim:", Object.fromEntries(formData)); // Debugging

				$.ajax({
					url: $(formElement).data("action"),
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function (response) {
						$("#submit_product").prop("disabled", false);
						if (response.status) {
							swallMssg_s(response.message, false, 1500)
								.then(() => location.reload());
						} else {
							swallMssg_e(response.message, true, 0);
						}
					},
					error: function (xhr, status, error) {
						$("#submit_product").prop("disabled", false);
						swallMssg_e('Terjadi kesalahan: ' + xhr.response, true, 0)
							.then(() => location.reload());
					},
				});
			});

			$('#addProduct').on('shown.bs.modal', function () {
				if (!map) {
					map = L.map('map').setView([-6.200, 106.816], 12);
					L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
						attribution: '© OpenStreetMap contributors'
					}).addTo(map);

					marker = L.marker([-6.200, 106.816], { draggable: true }).addTo(map);

					marker.on('dragend', function (event) {
						var position = event.target.getLatLng();
						console.log("📍 Latitude: " + position.lat + ", Longitude: " + position.lng);
						$("#latitude").val(position.lat);
						$("#longitude").val(position.lng);
					});

					// **Tambahkan Control Geocoder untuk Pencarian Lokasi**
					L.Control.geocoder({
						defaultMarkGeocode: false
					})
						.on('markgeocode', function(e) {
							var latlng = e.geocode.center;

							// Pindahkan marker ke lokasi yang dicari
							marker.setLatLng(latlng);
							map.setView(latlng, 15); // Zoom ke lokasi

							// Simpan ke dalam input form
							$("#latitude").val(latlng.lat);
							$("#longitude").val(latlng.lng);
						})
						.addTo(map);

					setTimeout(() => {
						map.invalidateSize();
					}, 500);
				}
			});
		});


		console.log(document.getElementById('map'));

		// Edit Location

		var updateMap;
		var updateMarker;
		$(document).ready(function () {
			var base_url = $('meta[name="base_url"]').attr('content');
			var geocoderControl; // Variabel untuk geocoder

			$('#updateLocationModal').on('shown.bs.modal', function (e) {
				var button = $(e.relatedTarget);
				var id_product = button.data('id_product');
				var latitude = button.data('latitude');
				var longitude = button.data('longitude');

				latitude = latitude ? parseFloat(latitude) : -6.200;
				longitude = longitude ? parseFloat(longitude) : 106.816;

				$("#latitude_update").val(latitude);
				$("#longitude_update").val(longitude);
				$("#edit_id_map").val(id_product);

				setTimeout(() => {
					if (!updateMap) {
						updateMap = L.map('mapUpdate').setView([latitude, longitude], 12);
						L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
							attribution: '© OpenStreetMap contributors'
						}).addTo(updateMap);

						updateMarker = L.marker([latitude, longitude], { draggable: true }).addTo(updateMap);

						updateMarker.on('dragend', function (event) {
							var position = event.target.getLatLng();
							$("#latitude_update").val(position.lat);
							$("#longitude_update").val(position.lng);
						});

						// **Tambahkan Geocoder (Fitur Search Location)**
						geocoderControl = L.Control.geocoder({
							defaultMarkGeocode: false
						}).on('markgeocode', function (e) {
							var latlng = e.geocode.center;
							updateMap.setView(latlng, 15);
							updateMarker.setLatLng(latlng);
							$("#latitude_update").val(latlng.lat);
							$("#longitude_update").val(latlng.lng);
						}).addTo(updateMap);

					} else {
						updateMap.setView([latitude, longitude], 12);
						updateMarker.setLatLng([latitude, longitude]);
					}

					setTimeout(() => {
						updateMap.invalidateSize();
					}, 500);
				}, 500);
			});

			$("#updateLocationForm").on("submit", function (e) {
				e.preventDefault();
				e.stopPropagation();

				console.log("Submit diklik");

				var formElement = this;
				var formData = new FormData(formElement);

				$.ajax({
					url: base_url + "/admin/product/update_location",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					dataType: "json",
					beforeSend: function () {
						$(".btn-primary").prop("disabled", true);
					},
					success: function (response) {
						$(".btn-primary").prop("disabled", false);

						if (response.status) {
							swallMssg_s(response.message, false, 1500).then(() => {
								location.reload();
							});
						} else {
							swallMssg_e(response.message, true, 0);
						}
					},
					error: function (xhr, status, error) {
						$(".btn-primary").prop("disabled", false);
						swallMssg_e("Terjadi kesalahan: " + error, true, 0).then(() => {
							location.reload();
						});
					}
				});
			});
		});



	</script>
</main>
