<main>
    <h1>Product</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="ti ti-plus"></i>
        Add User
    </button>

    <div class="mt-6">
        <table id="users_table" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Avatar</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_user as $users): ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $users['name']; ?></td>
                    <td><?= $users['email']; ?></td>
                    <td><?= ($users['status'] == 1) ? 'Active' : 'Banned'; ?></td>
                    <td><img src="<?= base_url('uploads/avatar/' . $users['avatar']); ?>" alt="Logo" width="50"></td>
                    <td><?= ($users['role'] == 1) ? 'Super user' : 'Admin'; ?></td>
                    <td>
                        <button 
                            class="btn gradient-btn-edit btn-sm mb-2 rounded-pill btn-edit" 
                            data-id="<?= $users['id']; ?>" 
                            data-name="<?= $users['name']; ?>" 
                            data-status="<?= $users['status']; ?>" 
                            data-role="<?= $users['role']; ?>" 
                            data-avatar="<?= $users['avatar']; ?>" 
                            data-email="<?= $users['email']; ?>">
                            EDIT
                        </button>
                        <button class="btn gradient-btn-delete mb-2 btn-sm rounded-pill btn-delete" data-id="<?= $users['id']; ?>">
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
                    <h3 class="modal-title">Add User</h3>

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
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('userdata/add_user') ?>" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Avatar</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                                <div class="form-group mb-5">
                                    <label for="edit_name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_url">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
  
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Status</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select id="status" class="form-select" aria-label="Default select example"
                                        name="status">
                                        <option selected>-Pilih status-</option>
                                        <option value="1">Active</option>
                                        <option value="2">Banned</option>
                                    </select>
                                </div>
  
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Role</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select id="role" class="form-select" aria-label="Default select example"
                                        name="role">
                                        <option selected>-Pilih role-</option>
                                        <option value="1">Super User</option>
                                        <option value="2">Admin</option>
                                    </select>
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
    <!-- Modal Edit -->
    <div class="modal fade" id="editUser" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit User</h3>

                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close" tabindex="-1" aria-labelledby="editAccount" aria-hidden="true">
                            <span class="svg-icon svg-icon-2">
                                <i class="ti ti-minus"></i>
                            </span>
                        </div>
                    </div>

                    <div class="modal-body">
                        <form class="form w-100" id="editUserForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Avatar</span>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="file" placeholder="avatar" id="avatar" name="avatar" autocomplete="off"
                                    class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Name</span>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Name" id="name" name="name" autocomplete="off"
                                    class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Email</span>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Email" id="email" name="email"
                                    autocomplete="off" class="form-control bg-transparent" />
                            </div>

                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Status</span>
                            </div>
                            <div class="fv-row mb-8">
                                    <select id="status" class="form-select" aria-label="Default select example"
                                        name="status">
                                        <option selected>-Pilih status-</option>
                                        <option value="1">Active</option>
                                        <option value="2">Banned</option>
                                    </select>
                            </div>

                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Role</span>
                            </div>
                            <div class="fv-row mb-8">
                                    <select id="role" class="form-select" aria-label="Default select example"
                                        name="role">
                                        <option selected>-Pilih role-</option>
                                        <option value="1">Super User</option>
                                        <option value="2">Admin</option>
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

    <script>
		$('#users_table').DataTable();
	</script>
</main>