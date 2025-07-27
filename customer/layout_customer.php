<!-- layout_customer.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mahkota Kaki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Mahkota Kaki 👟</a>
    <div class="d-flex">
      <a href="keranjang.php" class="btn btn-light">🛒 Keranjang</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <?= $content ?>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
  &copy; <?= date('Y') ?> Mahkota Kaki. All rights reserved.
</footer>

</body>
</html>
