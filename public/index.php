<?php

use app\database\models\Product;

require '../vendor/autoload.php';

$product = new Product;
$products = $product->all('id,name,slug,price,image');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart with js and php</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <div class="container">
    <div id="total-products-in-cart" class="d-flex justify-content-between align-middle">
      <div>
        Total products in cart <i class="bi bi-cart-check"></i>: <span id="totalQuantity" class="fw-bold">0</span>
        <span id="totalPrice" class="fw-bold">0</span>
      </div>
      <button id="btn-clear-cart" class="btn btn-danger btn-sm"><i class="bi bi-cart"></i> Clear cart</button>
    </div>
    <ul>
      <?php foreach ($products as $product) : ?>
        <li class="products-list" data-product='<?php echo $product->toJson(['id', 'name', 'price']) ?>'>
          <img src="<?php echo $product->image ?>" alt="" width="60" height="56">
          <?php echo $product->name ?> R$
          <?php echo number_format($product->price, 2, ',', '.') ?> |
          <span class="btn-add-to-cart" data-product='<?php echo $product->toJson(['id', 'name', 'price']) ?>'>
            <i class="bi bi-plus-circle add"></i>
          </span>

          <span class="btn-remove-from-cart" data-product='<?php echo $product->toJson(['id', 'name', 'price']) ?>'>
            <i class="bi bi-dash-circle minus"></i>
          </span>

          <span class="fst-italic fw-bold total-product-in-cart<?php echo $product->id ?>">0</span> in cart
          <span class="fst-italic fw-bold total-product-price-in-cart<?php echo $product->id ?>">0</span>
        </li>
      <?php endforeach ?>
    </ul>
  </div>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="module" src="./assets/js/main.js"></script>
</body>

</html>