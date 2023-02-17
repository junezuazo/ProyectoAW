<?php require "comps/header.php" ?>
<div class="container d-flex justify-content-center col-lg-5" id="borders-form">
  <form class="needs-validation" novalidate action="register.php" method="post">
    <div class="row g-3 p-4">
      <h2 class="mb-3 d-flex justify-content-center">Registro</h2>
    
      <hr class="mt-1">

      <div class="col-sm-12">
        <label for="mail" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="mail" placeholder="usuario@dominio.ext">
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

      <div class="col-sm-6">
        <label for="firstName" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" placeholder="Lorem">
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-sm-6">
        <label for="lastName" class="form-label">Apellidos</label>
        <input type="text" class="form-control" name="surname" placeholder="Ipsum">
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-12">
        <label for="address1" class="form-label">Dirección de correo postal</label>
        <input type="text" class="form-control" name="address1" placeholder="Calle/Avenida...">
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-12">
        <label for="address2" class="form-label">Portal, piso, puerta... <span
            class="text-muted">(Optional)</span></label>
        <input type="text" class="form-control" name="address2" placeholder="Portal 1, escalera A">
      </div>

      <div class="col-md-4">
        <label for="country" class="form-label">País</label>
        <span class="form-control">España</span>
      </div>

      <div class="col-md-5">
        <label for="state" class="form-label">Comunidad Autónoma</label>
        <select class="form-select" name="state" required>
          <option>Seleccionar...</option>
          <option>Andalucía</option>
          <option>Aragón</option>
          <option>Asturias</option>
          <option>Baleares</option>
          <option>Canarias</option>
          <option>Cantabria</option>
          <option>Castilla y León</option>
          <option>Castilla-La Mancha</option>
          <option>Cataluña</option>
          <option>Ceuta</option>
          <option>Extremadura</option>
          <option>Galicia</option>
          <option>La Rioja</option>
          <option>Madrid</option>
          <option>Melilla</option>
          <option>Murcia</option>
          <option>Navarra</option>
          <option>País Vasco</option>
          <option>Valencia</option>
        </select>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>

      <div class="col-md-3">
        <label for="zip" class="form-label">Código postal</label>
        <input type="text" class="form-control" name="zip" required>
        <div class="invalid-feedback">
          Por favor, rellene los campos obligatorios.
        </div>
      </div>
    </div>
    <div class="row g-3 m-1">
      <div class="form-check col-md-9">
        <input type="checkbox" class="form-check-input" id="same-address">
        <label class="form-check-label" for="same-address" required>Marque esta casilla para verificar que ha leído nuestros <a
            href="#">política de privacidad</a> y los <a href="#">términos y condiciones</a> del servicio.</label>
      </div>
    </div>

    <hr class="my-4">

    <button class="w-100 btn btn-primary btn-lg" type="submit">Registrarse</button>
  </form>
</div>

<?php require "comps/footer.php" ?>