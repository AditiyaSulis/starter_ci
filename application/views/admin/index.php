<main> 
    <?php if ($this->session->flashdata('authorize')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('authorize'); ?>
                </div>
    <?php endif; ?>
    <h1>Halaman Admin</h1>

    <div class="container mt-12" style="border: 2px dashe #000; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
        <div class="row"  style="display: flex;">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card"  style="width:220px;  margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?= $allSuperUsers?></h5>
                        <p class="card-text">Total Super Users</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card" style="width:220px; margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $allAdmins?></h5>
                        <p class="card-text">Total Admins</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card" style="width:220px;  margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $allUsers?></h5>
                        <p class="card-text">Total Users</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4 mt-10">
                <div class="card" style="width:220px;  margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $allProducts?></h5>
                        <p class="card-text">Total Products</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4 mt-10">
                <div class="card" style="width:220px;  margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $allEmployees?></h5>
                        <p class="card-text">Total Employees</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-10">
                <div class="card" style="width:220px;  margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $allRecords?></h5>
                        <p class="card-text">Total Finance Records</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>