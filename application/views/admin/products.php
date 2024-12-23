<main>
    <h1>Product</h1>

    <button type="button" class="btn btn-primary mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
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
                    <td><a href="<?= $product['url']; ?>"><?= $product['url']; ?></a></td>
                    <td><img src="<?= base_url('uploads/products/compressed/' . $product['logo']); ?>" alt="Logo" width="50"></td>
                    <td>
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-edit" 
                            data-id="<?= $product['id_product']; ?>" 
                            data-name="<?= $product['name_product']; ?>" 
                            data-description="<?= $product['description']; ?>" 
                            data-url="<?= $product['url']; ?>" 
                            data-logo="<?= $product['logo']; ?>">
                            EDIT
                        </button>
                        <button class="btn btn-danger mb-2 btn-sm rounded-pill btn-delete" data-id="<?= $product['id_product']; ?>">
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
                                    <input type="text" placeholder="Description" name="description" autocomplete="off" class="form-control bg-transparent"/> 
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
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
                                    <input type="text" class="form-control" id="edit_url" name="url" required>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
		$('#products_table').DataTable();
	</script>
</main>