<main>
    <h1>Supplier</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="ti ti-plus"></i>
        Add Supplier
    </button>

    <div class="mt-6">
        <table id="supplier_table" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($supplier as $sup): ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $sup['name_supplier']; ?></td>
                    <td><?= $sup['contact_info']; ?></td>
                    <td><?php if($sup['status_supplier'] == 1):?>
                            <button class="btn gradient-btn-active btn-sm rounded-pill btn-set"
                            data-id_supplier="<?= $sup['id_supplier']; ?>" 
                            data-status_supplier="<?= $sup['status_supplier']; ?>">
                                <i class="ti ti-check"></i> Active
                            </button>
                        <?php else:?> 
                            <button class="btn gradient-btn-inactive btn-sm rounded-pill btn-set" 
                            data-id_supplier="<?= $sup['id_supplier']; ?>" 
                            data-status_supplier="<?= $sup['status_supplier']; ?>">
                                <i class="bi bi-slash-circle"></i> In-Active
                            </button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button 
                            class="btn gradient-btn-edit btn-sm mb-2 rounded-pill btn-edit"  style="width : 70px"
                            data-id_supplier="<?= $sup['id_supplier']; ?>" 
                            data-name_supplier="<?= $sup['name_supplier']; ?>" 
                            data-contact_info="<?= $sup['contact_info']; ?>" 
                            data-status_supplier="<?= $sup['status_supplier']; ?>">
                            EDIT
                        </button>
                        <button class="btn gradient-btn-delete mb-2 btn-sm rounded-pill btn-delete-sp" data-id_supplier="<?= $sup['id_supplier']; ?>" style="width : 70px">
                            DELETE
                        </button>
                    </td>
                </tr>
                <?php $no++?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Add Supplier -->
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
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/supplier/add_supplier') ?>" enctype="multipart/form-data">
                                 <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Name</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Name Supplier" name="name_supplier" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                 <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Contact</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Contact Info" name="contact_info" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Status</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" name="status_supplier">
                                        <option selected>-Status-</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add Supplier
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
    <div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Supplier</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                    </div>

                </div>

                <div class="modal-body">
                            <form class="form w-100" id="editSupplierForm">
                                <input type="hidden" id="id_supplier" name="id_supplier">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Name</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Name Supplier" name="name_supplier" id="name_supplier" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                 <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Contact</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Contact Info" name="contact_info" id="contact_info" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Status</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" name="status_supplier" id="status_supplier">
                                        <option selected>-Status-</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
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

    <!-- MODAL SET ACTIVE -->
     <div class="modal fade" tabindex="-1" id="setStatusModal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Set Status</h4>

          
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
      
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="setStatusForm" enctype="multipart/form-data">
                            <input type="hidden" id="id_supplier_status" name="id_supplier">   
                            <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" id="setstatussupplier" name="status_supplier">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Set Status
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

    <script>
		$('#supplier_table').DataTable();
	</script>
</main>