<?php

use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\UserProductDAO;
use es\ucm\fdi\aw\DAO\UserDAO;

require_once 'includes/config.php';

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

$userDAO = new UserDAO;
$prodDAO = new ProductDAO;
$usersDAO = new UserProductDAO;
$subtotal = 0;
$my_array = array();
if (isset($_SESSION["user"])) {
    $userRoles = $userDAO->getUserRoles($_SESSION["user"]->getID());

    $_SESSION["isAdmin"] = false;

    foreach ($userRoles as $role) {
        if ($role->getRoleName() == "admin") {
            $_SESSION["isAdmin"] = true;
        }
    }
}
$cartCount = 0;
if (isset($_SESSION["user"])) {
    $uID = $_SESSION["user"]->getID();
    $my_array = $usersDAO->getUserCart($uID);
} else if (!empty($_SESSION["carritoTemporal"])) { //Hay que crear el carrito a corde al usuario sin registrar
    $uID = -1;
    $my_array = $_SESSION["carritoTemporal"];
}

foreach($my_array as $elem){
    $cartCount = $cartCount + $elem->getAmount();    
}

$current_page = basename($_SERVER['PHP_SELF']);
$logoPath = 'images/logo.png';

$menu = array(
    "index.php" => 'Inicio',
    "products.php" => 'Productos',
    "forum.php" => 'Foro',
    "events.php" => 'Eventos',
    "faqs.php" => 'FAQs',
    "information.php" => 'Información',
    "contact.php" => 'Contacto'
);
?>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="<?= $logoPath ?>" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center">
                <?php foreach ($menu as $key => $value) : ?>
                    <li class="nav-item">
                        <a class="nav-link<?= $key == $current_page ? ' active' : '' ?>" href="<?= $key ?>"><?= $value ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
            <form action="shoppingCart.php">
                <button type="submit" class="rounded-circle btn btn-outline-light me-3 pt-1"  onclick="modifyCart()" onmouseover="showCart()" onmouseout="hideCart()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <?php if ($cartCount > 0) : ?>
                        <span id="contador" class="badge bg-danger rounded-circle"><?= $cartCount ?></span>
                    <?php endif ?>
                </button>
                <div class="dropdown" >
                    
                        <ul  id="cart-dropdown" class="dropdown-menu dropdown-menu-dark" onmouseover="showCart()" onmouseout="hideCart()">
                            <?php if (empty($my_array)) : ?>
                                <p class="text-center">El carrito está vacío.</p>
                            <?php else : ?>
                            <?php $cartCount = 0;
                            foreach ($my_array as $product) : ?>
                                <?php if ($product->getID1() == $uID) :
                                    $producto = $prodDAO->read($product->getID2())[0];
                                    $subtotal = $subtotal + ($producto->getOfferPrice() * $product->getAmount());

                                ?>
                                    <li class="dropdown-item" >
                                        <?php echo "Cantidad: " . $product->getAmount() ?>
                                        <a class="dropdown-item" href="product.php?productID=<?= $producto->getID() ?>"><?php echo "Producto " . $producto->getName() ?> </a> 
                                        <?= ($delete =  new es\ucm\fdi\aw\forms\DeleteProductFromCartForm($producto->getID()))->handleForm(); ?>

                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                            <li class = "text-danger">
                                <?php echo "Subtotal " .  $subtotal ?>
                            </li>
                        </ul>
                    <?php endif ?>
                </div>
            </form>
            <?php if (isset($_SESSION["user"])) : ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hola, <?= $_SESSION["user"]->getName() ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="account.php">Cuenta</a></li>
                        <li><a class="dropdown-item" href="orders.php">Pedidos</a></li>
                        <li><a class="dropdown-item" href="#">Lista de deseos</a></li>
                        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION['isAdmin'] == true) : ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="adminPanel.php">Administrar</a></li>
                        <?php endif ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            <?php else : ?>
                <form action="login.php">
                    <input type="hidden" name="urlRedirection" value="<?= $_SESSION['url'] ?>">
                    <button class="btn btn-primary m-1" type="submit">Iniciar sesión</button>
                </form>
                <form action="register.php">
                    <button class="btn btn-secondary m-1" type="submit">Registrarse</button>
                </form>
            <?php endif ?>
        </div>
    </div>
    <script>
        

        function showCart() {
            document.getElementById("cart-dropdown").classList.add("show");
        }

        function hideCart() {
            document.getElementById("cart-dropdown").classList.remove("show");
        }

        document.querySelector('.btn-outline-secondary').onmouseover = showCart;
        document.querySelector('.btn-outline-secondary').onmouseleave = hideCart;

    </script>
</nav>