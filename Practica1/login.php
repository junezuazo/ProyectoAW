<?php require "comps/header.php" ?>
<div class="container d-flex justify-content-center col-lg-4" id="borders-form">
  <form class="needs-validation" novalidate>
    <div class="row g-3 p-4">
      <h2 class="mb-3 d-flex justify-content-center">Inciar sesión</h2>

      <hr class="my-4">

      <div class="col-sm-12">
        <label for="mail" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="mail" placeholder="usuario@dominio.ext" required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-sm-12">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" placeholder="********" required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" type="submit">Entrar</button>
  </form>
</div>
<?php require "comps/footer.php" ?>