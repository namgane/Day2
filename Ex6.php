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
     <div class="container mt-5">
  <h3>PHP Exercise 2</h3>
  <div class="row mt-4">
    <?php
    foreach ($_SESSION['prods'] as $item) {
    ?>
    <div class="col-md-2 d-flex flex-column gap-3">
      <img src="https://placehold.co/150x150" class="img-thumbnail" alt="thumb1">
      <img src="https://placehold.co/150x150" class="img-thumbnail" alt="thumb2">
      <img src="https://placehold.co/150x150" class="img-thumbnail" alt="thumb3">
    </div>
    <div class="col-md-3 col-sm-6">   
      <div class="card" style="width: 18rem;">
        <a href="prodDetails.php?id=<?php echo $item->id; ?>">
          <img src="<?php echo $item->image; ?>" class="card-img-top" alt="<?php echo $item->name; ?>">
        </a>
      </div>
    </div>
    <div class="col-md-7 col-sm-12">
      <div class="row">
        <div class="col-md-4">
          <div class="card-body">
            <h5 class="card-title"><?php echo $item->name; ?></h5>
            <p class="card-text"><?php echo $item->short_description; ?></p>
            <p class="card-text"><strong><?php echo number_format($item->price); ?> đ</strong></p>
            <div class="input-group mb-3">
            <button class="btn btn-outline-secondary" type="button">-</button>
            <input type="text" class="form-control text-center" value="1">
            <button class="btn btn-outline-secondary" type="button">+</button>
          </div>
          <button class="btn btn-outline-danger mb-3 w-100">Mua sản phẩm</button>
           <p><strong>Đánh giá sản phẩm</strong></p>
          <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <span>0/5 (0 đánh giá)</span>
          </div>
        </div>

       
      </div>
    </div>
    <?php
    }
    ?>
  </div>
</div> 
    </div>
    <div class="col-12 mt-4">
  <div class="accordion" id="productAccordion">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingDetails">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDetails" aria-expanded="true" aria-controls="collapseDetails">
          Chi tiết sản phẩm
        </button>
      </h2>
      <div id="collapseDetails" class="accordion-collapse collapse show" aria-labelledby="headingDetails" data-bs-parent="#productAccordion">
        <div class="accordion-body">
          Đây là sản phẩm áo kiểu tay ngắn phối ren, chất liệu mềm mại, dễ chịu khi mặc.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="headingGuide">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGuide" aria-expanded="false" aria-controls="collapseGuide">
          Hướng dẫn bảo quản
        </button>
      </h2>
      <div id="collapseGuide" class="accordion-collapse collapse" aria-labelledby="headingGuide" data-bs-parent="#productAccordion">
        <div class="accordion-body">
          Giặt tay với nước lạnh, không dùng chất tẩy mạnh, ủi ở nhiệt độ thấp.
        </div>
      </div>
    </div>
  </div>
</div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>