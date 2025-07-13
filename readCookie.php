<?php
session_start();

class Product
{
    public $id, $sku, $name, $short_description, $description, $price, $rating, $instruction, $image;

    public function __construct($id, $sku, $name, $short_description, $description, $price, $rating, $instruction, $image)
    {
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

// Danh sách sản phẩm với ảnh từ placehold.co
$prods = [];
$prods[] = new Product(
    1,
    'FAVH122124SHO01',
    'Đầm mini tơ thêu họa tiết',
    'Đầm mini tơ thêu họa tiết, form suông, xếp li thân trước.',
    'Đầm mini tơ thêu họa tiết form suông xếp li thân trước, chất liệu cao cấp, thoáng mát.',
    800000,
    5.0,
    '',
    'https://placehold.co/120x120/ffefef/222?text=Đầm+mini'
);
$prods[] = new Product(
    2,
    'FAVH122124SHO02',
    'Đầm maxi hoa nhí cổ vuông',
    'Đầm maxi hoa nhí, cổ vuông, dáng dài nữ tính.',
    'Đầm maxi hoa nhí cổ vuông, phù hợp đi chơi, dạo phố, dự tiệc.',
    950000,
    4.8,
    '',
    'https://placehold.co/120x120/fffbe7/222?text=Đầm+maxi'
);
$prods[] = new Product(
    3,
    'FAVH122124SHO03',
    'Áo sơ mi lụa tay dài',
    'Áo sơ mi lụa, tay dài, mềm mịn, sang trọng.',
    'Áo sơ mi lụa tay dài, thích hợp đi làm, đi chơi, dễ phối đồ.',
    600000,
    4.9,
    '',
    'https://placehold.co/120x120/e3f2fd/222?text=Sơ+mi+lụa'
);
$prods[] = new Product(
    4,
    'FAVH122124SHO04',
    'Quần jeans ống rộng',
    'Quần jeans ống rộng, trẻ trung, năng động.',
    'Quần jeans ống rộng, chất liệu dày dặn, co giãn tốt.',
    700000,
    4.7,
    '',
    'https://placehold.co/120x120/efebe9/222?text=Jeans'
);

$_SESSION['prods'] = $prods;

// Xử lý đặt hàng và lưu vào session/cart
if (isset($_POST['order'])) {
    $cart = [];
    foreach ($prods as $product) {
        $qty = isset($_POST['qty'][$product->id]) ? (int)$_POST['qty'][$product->id] : 0;
        if ($qty > 0) {
            $cart[$product->id] = $qty;
        }
    }
    $_SESSION['cart'] = $cart;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Xử lý thanh toán
if (isset($_POST['checkout'])) {
    $_SESSION['cart'] = [];
    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
    exit();
}

// Đọc giỏ hàng từ session
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

// Xử lý xem chi tiết sản phẩm
$detail = null;
if (isset($_GET['detail'])) {
    $detailId = (int)$_GET['detail'];
    foreach ($prods as $p) {
        if ($p->id == $detailId) {
            $detail = $p;
            break;
        }
    }
}

// Kiểm tra trạng thái thanh toán thành công
$success = isset($_GET['success']) && $_GET['success'] == 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shop Thời Trang Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-4">
    <?php if ($success): ?>
        <div class="alert alert-success text-center p-5 mt-5">
            <h2 class="mb-4">🎉 Thanh toán thành công!</h2>
            <p>Cảm ơn bạn đã mua hàng tại shop của chúng tôi.</p>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-primary mt-3">Quay lại trang chủ</a>
        </div>
    <?php elseif ($detail): ?>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary mb-3">&laquo; Quay lại danh sách</a>
        <div class="card mb-4" style="max-width:600px;margin:auto;">
            <div class="row g-0">
                <div class="col-md-5 text-center p-3">
                    <img src="<?php echo $detail->image; ?>" class="img-fluid" alt="">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 class="card-title text-primary"><?php echo $detail->name; ?></h3>
                        <p class="card-text"><?php echo $detail->description; ?></p>
                        <div class="mb-2">
                            <span class="fw-bold text-danger fs-4"><?php echo number_format($detail->price); ?> VNĐ</span>
                        </div>
                        <div class="mb-2">
                            Đánh giá:
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php echo $i <= $detail->rating ? '★' : '☆'; ?>
                            <?php endfor; ?>
                        </div>
                        <form method="post" class="row g-2">
                            <div class="col-6">
                                <input type="number" class="form-control" name="qty[<?php echo $detail->id; ?>]" min="1" value="1">
                            </div>
                            <div class="col-6">
                                <button type="submit" name="order" class="btn btn-success w-100">Thêm vào giỏ hàng</button>
                            </div>
                        </form>
                        <div class="mt-3">
                            <span class="text-muted">SKU: <?php echo $detail->sku; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
    <h2 class="text-center text-primary mb-4">Shop Thời Trang Đơn Giản</h2>
    <form method="post">
        <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-warning">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Đánh giá</th>
                    <th>Số lượng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($prods as $product): ?>
                <tr>
                    <td><img src="<?php echo $product->image; ?>" width="80" height="80" alt=""></td>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $product->short_description; ?></td>
                    <td class="text-danger fw-bold"><?php echo number_format($product->price); ?> VNĐ</td>
                    <td>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php echo $i <= $product->rating ? '★' : '☆'; ?>
                        <?php endfor; ?>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="qty[<?php echo $product->id; ?>]" min="0" value="0">
                    </td>
                    <td>
                        <a href="?detail=<?php echo $product->id; ?>" class="btn btn-outline-info btn-sm">Xem chi tiết</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <div class="text-center">
            <button type="submit" name="order" class="btn btn-success px-4">Thêm vào giỏ hàng</button>
        </div>
    </form>
    <?php
    // Hiển thị giỏ hàng từ session
    if (!empty($cart)) {
        $total = 0;
        echo '<div class="mt-5">';
        echo '<h3 class="text-success">Giỏ hàng của bạn:</h3>';
        echo "<ul class='list-group'>";
        foreach ($prods as $product) {
            $qty = isset($cart[$product->id]) ? (int)$cart[$product->id] : 0;
            if ($qty > 0) {
                $line = $qty * $product->price;
                $total += $line;
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>{$product->name} <span>x {$qty} = <span class='text-danger'>" . number_format($line) . " VNĐ</span></span></li>";
            }
        }
        echo "</ul>";
        if ($total > 0) {
            echo "<form method='post' class='mt-3 text-end'>";
            echo "<button type='submit' name='checkout' class='btn btn-primary'>Thanh toán</button>";
            echo "</form>";
        }
        echo "<div class='mt-3 fw-bold fs-5'>Tổng cộng: <span class='text-danger'>" . number_format($total) . " VNĐ</span></div>";
        echo '</div>';
    }
    ?>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>