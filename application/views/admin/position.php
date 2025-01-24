<main>
    <h1>Division & Position</h1>

<div class="row mt-12">
    <div class="col-md-12 mb-4">
        <h4>Position</h4>
        <button type="button" class="btn gradient-btn rounded-pill mt-6 mb-6" data-bs-toggle="modal" data-bs-target="#addPosition"> 
            <i class="bi bi-plus-circle"></i>
            Add Position
        </button>

        <ul class="nav nav-tabs mt-8 mb-8">
            <li class="nav-item">
                <a class="nav-link text-dark" aria-current="page" href="<?=base_url('admin/division/division_page')?>">Division</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  active text-info" href="<?=base_url('admin/position/position_page')?>">Position</a>
            </li>
        </ul>

        <div class="table-responsive">
            <table id="position_table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <?php $no = 1 ?>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($position as $pst): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $pst['code_position']; ?></td>
                            <td><?= $pst['name_position']; ?></td>
                            <td> 
                                <a href="javascript:void(0)" onclick="editPstButton(this)" class="btn gradient-btn-edit mb-2 btn-sm rounded-pill btn-edit-pst" style="width : 70px"
                                        data-id_position="<?= $pst['id_position']; ?>"
                                        data-code_position="<?= $pst['code_position']; ?>"
                                        data-name_position="<?= $pst['name_position']; ?>">
                                    EDIT
                                </a>
                                <button  class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-pst" data-id_position="<?= $pst['id_position']; ?>" style="width : 70px">
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


<!-- Modal Add Position -->
<div class="modal fade" tabindex="-1" id="addPosition">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Position</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="addPositionForm" data-action="<?= site_url('admin/position/add_position') ?>">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Code Position</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Code" name="code_position" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Name</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Name division" name="name_position" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_position" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add position
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

<!-- Modal Edit Position -->
<div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Position</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                    </div>

                </div>

                <div class="modal-body">
                            <form class="form w-100" id="editPositionForm" enctype="multipart/form-data">
                                    <input type="hidden" name="id_position" id="id_position">
                                    <div class="mb-3">
                                        <label for="date_in" class="form-label">Code</label>
                                        <input type="text" name="code_position" id="code_position" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">Name</label>
                                        <input type="text" name="name_position" id="name_position" class="form-control">
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
    $('#position_table').DataTable();
</script>

</main>



