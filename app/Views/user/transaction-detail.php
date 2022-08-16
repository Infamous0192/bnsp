<?= $this->extend('user/layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Transaction</h3>
        <p class="text-subtitle text-muted">Transaction Detail.</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/user">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transaction</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <?php if (session()->getFlashData('pesan')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashData('pesan') ?></div>
  <?php endif; ?>

  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4>Transaction (#<?= $transaction['id'] ?>)</h4>
        <h5>
            Status: <?= $transaction['status'] ?>
        </h5>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>ID Product</th>
              <th>Product</th>
              <th>Descrition</th>
              <th>Price</th>
              <th>Thumbnail</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) : ?>
              <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['title'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['price'] ?></td>
                <td>
                  <img src="/files/product/<?= $product['thumbnail'] ?>" width="200" class="img-thumbnail" alt="product">
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php if ($transaction['status'] == 'pending') : ?>
            <div class="d-flex justify-content-between">
                <a href="/user/transaction/<?= $transaction['id'] ?>/bayar">
                    <button class="btn btn-primary px-4">
                        Bayar
                    </button>
                </a>
            </div>
        <?php endif; ?>
      </div>
    </div>

  </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="/assets/vendors/simple-datatables/style.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
  // Simple Datatable
  let table1 = document.querySelector('#table1');
  let dataTable = new simpleDatatables.DataTable(table1);
</script>
<?= $this->endSection() ?>