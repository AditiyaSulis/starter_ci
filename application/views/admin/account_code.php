<main>
    <h1>Account Code & Category</h1>

<div class="row mt-12">
    <div class="col-md-6 mb-4">
        <h4>Account Code</h4>
        <div class="table-responsive">
            <table id="account_code_table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <?php $no = 1 ?>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Code</th>
                        <th>Name Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($account_code as $ac): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $ac['name_kategori']; ?></td>
                            <td><?= $ac['code']; ?></td>
                            <td><?= $ac['name_code']; ?></td>
                        </tr>
                    <?php $no++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <h4>Category</h4>
        <div class="table-responsive">
            <table id="category_table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no2 = 1; ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?=$no2 ?></td>
                            <td><?= $category['name_kategori']?></td>
                            <td><?= $category['type_kategori']?></td>
                        </tr>
                     <?php $no2++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#account_code_table').DataTable();
    $('#category_table').DataTable();
</script>

</main>