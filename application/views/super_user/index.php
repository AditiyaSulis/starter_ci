
<main> 
    <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-primary" role="alert">
                    <?= $this->session->flashdata('success'); ?>
                </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('error'); ?>
                </div>
    <?php endif; ?>

    <h1>Halaman Superuser</h1>
    <div class="mt-5">
        <form action="<?= base_url('upload/do_upload') ?>" method="post" enctype="multipart/form-data">
            <label for="file">Pilih File:</label>
            <input type="file" name="userfile" id="file">
            <button type="submit">Upload</button>
        </form>
    </div>

    <div class="container mt-12" style="border: 2px dashe #000; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
        <div class="row"  style="display: flex;">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card"  style="width:200px;  margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?= $allSuperUsers?></h5>
                        <p class="card-text">Total Super Users</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card" style="width:200px; margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $allAdmins?></h5>
                        <p class="card-text">Total Admins</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card" style="width:200px;  margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $allUsers?></h5>
                        <p class="card-text">Total Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>