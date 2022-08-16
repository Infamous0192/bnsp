<?= $this->extend('auth/layout') ?>

<?= $this->section('content') ?>
<div class="row h-100">
  <div class="col-lg-5 col-12">
    <div id="auth-left">
      <div class="auth-logo">
        <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Logo"></a>
      </div>
      <h1 class="auth-title">Log in.</h1>
      <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

      <?php if (session()->getFlashData('pesan')) : ?>
        <div class="alert alert-warning" role="alert"><?= session()->getFlashData('pesan') ?></div>
      <?php endif; ?>

      <form action="/login" method="post">
        <div class="form-group position-relative has-icon-left mb-4">
          <input name="username" type="text" class="form-control form-control-xl <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" value="<?= old('username') ?>" id="price" placeholder="Username">
          <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            <?= $validation->getError('username') ?>
          </div>
          <div class="form-control-icon">
            <i class="bi bi-person"></i>
          </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
          <input name="password" type="password" class="form-control form-control-xl <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" value="<?= old('password') ?>" id="price" placeholder="Password">
          <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            <?= $validation->getError('password') ?>
          </div>
          <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
        </div>

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
      </form>
      <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">Don't have an account? <a href="/daftar" class="font-bold">Sign
            up</a>.</p>
        <p><a class="font-bold" href="/masuk">Forgot password?</a>.</p>
      </div>
    </div>
  </div>
  <div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
  </div>
</div>
<?= $this->endSection() ?>