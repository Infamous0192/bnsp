<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Add Product</h3>
        <p class="text-subtitle text-muted">Add Product Form</p>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <section id="input-validation">
    <div class="row">
      <div class="col-12">
        <form class="card" action="/admin/product/post" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="title" class="col-form-label">Title</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="title" type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>" id="title" value="<?= old('title') ?>" required>
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      <?= $validation->getError('title') ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="description" class="col-form-label">Description</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="description" type="text" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>" id="description" value="<?= old('description') ?>" required>
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      <?= $validation->getError('description') ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="price" class="col-form-label">Price</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="price" type="number" class="form-control <?= ($validation->hasError('price')) ? 'is-invalid' : '' ?>" id="price" value="<?= old('price') ?>" required>
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      <?= $validation->getError('price') ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group row align-items-center">
                  <div class="col-lg-2 col-3">
                    <label for="thumbnail" class="col-form-label">Thumbnail</label>
                  </div>
                  <div class="col-lg-10 col-9">
                    <input name="thumbnail" class="form-control <?= ($validation->hasError('thumbnail')) ? 'is-invalid' : '' ?>" type="file" id="thumbnail" value="<?= old('thumbnail') ?>" required>
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      <?= $validation->getError('thumbnail') ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                  Add
                </button>
              </div>

            </div>
          </div>
      </div>
    </div>
</div>
</section>
<!-- validations end -->

</div>
<?= $this->endSection() ?>