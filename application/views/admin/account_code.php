<main>
    <h1>Account Code & Category</h1>

<div class="row mt-12">
    <div class="col-md-12 mb-4">
        <h4>Account Code</h4>
        <button type="button" class="btn btn-primary rounded-pill mt-3 mb-6 btn-sm" data-bs-toggle="modal" data-bs-target="#addProduct"> 
            <i class="ti ti-plus"></i>
            Add Account Code
        </button>
        <div class="table-responsive">
            <table id="account_code_table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <?php $no = 1 ?>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Code</th>
                        <th>Name Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($account_code as $ac): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ac['name_kategori']; ?></td>
                            <td><?= $ac['code']; ?></td>
                            <td><?= $ac['name_code']; ?></td>
                            <td> 
                                <a href="javascript:void(0)" onclick="editAcButton(this)" class="btn btn-warning mb-2 btn-sm rounded-pill btn-edit-ac" 
                                        data-id_code="<?= $ac['id_code']; ?>"
                                        data-kategori="<?= $ac['id_kategori']; ?>"
                                        data-code="<?= $ac['code']; ?>"
                                        data-name_code="<?= $ac['name_code']; ?>">
                                    EDIT
                                </a>
                                <button  class="btn btn-danger btn-sm mb-2 rounded-pill btn-delete-ac" data-id="<?= $ac['id_code']; ?>">
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
                    <h3 class="modal-title">Add Account Code</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/account_code/add_account_code') ?>">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Category</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select id="kategori" class="form-select" aria-label="Default select example" name="id_kategori">
                                        <option selected>-Pilih Category-</option>
                                        <?php foreach ($categories as $ctg): ?>
                                            <option value="<?= $ctg['id_kategori'] ?>"><?= $ctg['name_kategori'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Code</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="number" placeholder="Code" name="code" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Name</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Name code" name="name_code" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add Account Code
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
<div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Account Code</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                    </div>

                </div>

                <div class="modal-body">
                            <form class="form w-100" id="editAccountForm" enctype="multipart/form-data">
                                    <input type="hidden" name="id_code" id="id_code">
                                    <div class="mb-3">
                                        <label for="id_product" class="form-label">Category</label>
                                        <select name="id_kategori" id="id_kategori" class="form-select">
                                            <?php foreach ($categories as $ct): ?>
                                                <option value="<?= $ct['id_kategori']; ?>"><?= $ct['name_kategori'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_in" class="form-label">Code</label>
                                        <input type="number" name="code" id="code" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">Name</label>
                                        <input type="text" name="name_code" id="name_code" class="form-control">
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
    $('#account_code_table').DataTable();
</script>

</main>