<main>
    <h1>Product</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="bi bi-plus-circle"></i>
        Add Product
    </button>

    <div class="mt-6">
        <table id="products_table" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Url</th>
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
                        <a href="<?= $product['url']; ?>">
                            <button class="btn btn-light btn-sm">
                                <i class="ti ti-link"></i>
                            </button>
                        </a>
                        <?php else:?> 

                        <?php endif; ?>
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
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/product/add_products') ?>" enctype="multipart/form-data">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Logo</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="file" placeholder="Logo" name="logo" autocomplete="off" class="form-control bg-transparent" required/> 
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
		$('#products_table').DataTable();

        function showImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').style.display = 'flex';
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }
	</script>
</main>