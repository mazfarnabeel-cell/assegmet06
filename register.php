```php
<?php
$nama = "";
$email = "";
$username = "";
$password = "";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil input dan melindungi output dari XSS
    $nama = htmlspecialchars(trim($_POST["nama"] ?? ""), ENT_QUOTES, "UTF-8");
    $email = htmlspecialchars(trim($_POST["email"] ?? ""), ENT_QUOTES, "UTF-8");
    $username = htmlspecialchars(trim($_POST["username"] ?? ""), ENT_QUOTES, "UTF-8");
    $password = $_POST["password"] ?? "";

    // Validasi Nama
    if (empty($nama)) {
        $errors["nama"] = "Nama lengkap wajib diisi.";
    }

    // Validasi Email
    if (empty($email)) {
        $errors["email"] = "Alamat email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format email tidak valid.";
    }

    // Validasi Username
    if (empty($username)) {
        $errors["username"] = "Username wajib diisi.";
    } elseif (strlen($username) < 4) {
        $errors["username"] = "Username minimal 4 karakter.";
    }

    // Validasi Password
    if (empty($password)) {
        $errors["password"] = "Password wajib diisi.";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Password minimal 6 karakter.";
    }

    // Jika tidak ada kesalahan
    if (empty($errors)) {
        $pesan = "Registrasi berhasil!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrasi Pengguna</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f2f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 420px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
        }

        .error {
            color: #d93025;
            font-size: 13px;
            margin-top: 5px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Registrasi Pengguna Baru</h2>

    <?php if (isset($pesan)): ?>
        <div class="success">
            <?= htmlspecialchars($pesan, ENT_QUOTES, "UTF-8"); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        <label for="nama">Nama Lengkap</label>

        <input
            type="text"
            id="nama"
            name="nama"
            value="<?= htmlspecialchars($nama, ENT_QUOTES, "UTF-8"); ?>"
        >

        <?php if (isset($errors["nama"])): ?>
            <div class="error">
                <?= $errors["nama"]; ?>
            </div>
        <?php endif; ?>


        <label for="email">Alamat Email</label>

        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($email, ENT_QUOTES, "UTF-8"); ?>"
        >

        <?php if (isset($errors["email"])): ?>
            <div class="error">
                <?= $errors["email"]; ?>
            </div>
        <?php endif; ?>


        <label for="username">Username</label>

        <input
            type="text"
            id="username"
            name="username"
            value="<?= htmlspecialchars($username, ENT_QUOTES, "UTF-8"); ?>"
        >

        <?php if (isset($errors["username"])): ?>
            <div class="error">
                <?= $errors["username"]; ?>
            </div>
        <?php endif; ?>


        <label for="password">Password</label>

        <input
            type="password"
            id="password"
            name="password"
        >

        <?php if (isset($errors["password"])): ?>
            <div class="error">
                <?= $errors["password"]; ?>
            </div>
        <?php endif; ?>


        <button type="submit">Daftar</button>

    </form>

</div>

</body>
</html>
```