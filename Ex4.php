<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <title>Product</title>
</head>
<body>
  <?php
  session_start();
  ?>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4"> 
    <div class="container-fluid"> 
      <a class="navbar-brand" href="#">Top navbar</a> 
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> 
        <span class="navbar-toggler-icon"></span> 
      </button> 
      <div class="collapse navbar-collapse" id="navbarCollapse"> 
        <ul class="navbar-nav me-auto mb-2 mb-md-0"> 
          <li class="nav-item"> 
            <a class="nav-link active" aria-current="page" href="#">Home</a> 
          </li> 
          <li class="nav-item"> 
            <a class="nav-link" href="#">Link</a> 
          </li> 
          <li class="nav-item"> 
            <a class="nav-link disabled" aria-disabled="true">Disabled</a> 
          </li> 
        </ul> 
        <form class="d-flex" role="search"> 
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
          <button class="btn btn-outline-success" type="submit">Search</button> 
        </form> 
      </div> 
    </div> 
  </nav>

  <main class="container mt-5">
    <div class="row">
      <?php
      class Product
      {
        public function __construct($id, $sku, $name, $short_description,
              $description, $price, $rating, $instruction, $image) {
          $this->id = $id;
          $this->sku = $sku;
          $this->name = $name;
          $this->short_description = $short_description;
          $this->description = $description;
          $this->price = $price;
          $this->rating = $rating;
          $this->instruction = $instruction;
          $this->image = $image;
        }
      }

      $prods = [];
      $p1 = new Product(1, 'FAVH122124SHO01', 'Đầm mini tơ thêu họa tiết form suông xếp li thân trước', 'Đầm mini tơ thêu họa tiết form suông xếp li thân trước', 'Đầm mini tơ thêu họa tiết form suông xếp li thân trước', 800000, 5.0, '', 'https://placehold.co/400');
      $prods[] = $p1;

      $_SESSION['prods'] = $prods;
      ?>

      <?php
      foreach ($_SESSION['prods'] as $item) {
      ?>
      <div class="col-md-3 col-sm-6">
        <div class="card" style="width: 18rem;">
          <a href="prodDetails.php?id=<?php echo $item->id; ?>">
            <img src="<?php echo $item->image; ?>" class="card-img-top" alt="<?php echo $item->name; ?>">
          </a>
          <div class="card-body">
            <h5 class="card-title"><?php echo $item->name; ?></h5>
            <p class="card-text"><?php echo $item->short_description; ?></p>
            <p class="card-text"><strong><?php echo number_format($item->price); ?> đ</strong></p>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
          </div>
        </div>
      </div>
      <?php
      }
      ?>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>