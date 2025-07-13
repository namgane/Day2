<?php
class Customer {
    public $id;
    public $username;
    public $password;
    public $fullname;
    public $address;
    public $phone;
    public $gender;
    public $birthday;

    public function __construct($id, $username, $password, $fullname, $address, $phone, $gender, $birthday) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->address = $address;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->birthday = $birthday;
    }
}
?>
<?php
session_start();

if (!isset($_SESSION['customers'])) {
    $_SESSION['customers'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    $newCustomer = new Customer($id, $username, $password, $fullname, $address, $phone, $gender, $birthday);
    $_SESSION['customers'][] = $newCustomer;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2>Add New Customer</h2>
    <form method="POST" class="row g-3">
        <div class="col-md-4">
            <label>ID</label>
            <input type="text" name="id" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label>Gender</label><br>
            <select name="gender" class="form-select" required>
                <option value="">Select</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>
        <div class="col-md-4">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Add Customer</button>
        </div>
    </form>

    <hr>

    <h2>Customer List</h2>
    <?php if (!empty($_SESSION['customers'])): ?>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['customers'] as $cust): ?>
                    <tr>
                        <td><?= htmlspecialchars($cust->id) ?></td>
                        <td><?= htmlspecialchars($cust->username) ?></td>
                        <td><?= htmlspecialchars($cust->password) ?></td>
                        <td><?= htmlspecialchars($cust->fullname) ?></td>
                        <td><?= htmlspecialchars($cust->address) ?></td>
                        <td><?= htmlspecialchars($cust->phone) ?></td>
                        <td><?= htmlspecialchars($cust->gender) ?></td>
                        <td><?= htmlspecialchars($cust->birthday) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No customers added yet.</p>
    <?php endif; ?>

</body>
</html>
