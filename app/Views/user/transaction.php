<?= $this->extend('user/layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Transactions</h3>
        <p class="text-subtitle text-muted">Your Transaction so far.</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/user">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
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
      <div class="card-header d-flex align-items-center justify-content-between">
        <h4>Transactions</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>ID Transaksi</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($transactions as $transaction) : ?>
              <tr>
                <td><?= $transaction['id'] ?></td>
                <td><?= $transaction['status'] ?></td>
                <td>
                  <a href="/user/transaction/<?= $transaction['id'] ?>">
                    <button class="btn btn-sm btn-primary d-flex align-items-center">
                      <i class="bi bi-eye-fill"></i>
                      Detail
                    </button>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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