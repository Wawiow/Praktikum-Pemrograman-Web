<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Motor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Motor</h1>
        
        <?php
        // Include file koneksi database
        include_once("config.php");
        
        // Cek apakah form telah di-submit
        if(isset($_POST['submit'])) {
            $id_Motor = $_POST['id_Motor'];
            $Merk_Motor = $_POST['Merk_Motor'];
            $Tahun_pembuatan = $_POST['Tahun_pembuatan'];
            $Harga_Sewa_perHari = $_POST['Harga_Sewa_perHari'];
            $Status_Motor = $_POST['Status_motor'];
            
            // Validasi form
            $errors = array();

            if(empty($id_Motor)) {
                $errors[] = "ID tidak boleh kosong";
            }
            
            if(empty($Merk_Motor)) {
                $errors[] = "Merk tidak boleh kosong";
            }
            
            if(empty($Tahun_pembuatan)) {
                $errors[] = "Tahun tidak boleh kosong";
            }
            
            if(empty($Harga_Sewa_perHari)) {
                $errors[] = "Harga tidak boleh kosong";
            }
            
            // Jika tidak ada error, simpan data
            if(empty($errors)) {
                // Gunakan prepared statement untuk keamanan
                $stmt = $conn->prepare("INSERT INTO motor(id_Motor, Merk_Motor, Tahun_pembuatan, Harga_Sewa_perHari, Status_motor) VALUES(?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $id_Motor, $Merk_Motor, $Tahun_pembuatan, $Harga_Sewa_perHari, $Status_Motor);
                
                if($stmt->execute()) {
                    echo "<div style='padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 15px;'>";
                    echo "Data berhasil ditambahkan. <a href='index.php'>Lihat Data</a>";
                    echo "</div>";
                } else {
                    echo "<div style='padding: 10px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 15px;'>";
                    echo "Error: " . $stmt->error;
                    echo "</div>";
                }
                $stmt->close();
            } else {
                echo "<div style='padding: 10px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 15px;'>";
                echo "<ul>";
                foreach($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
                echo "</div>";
            }
        }
        ?>
        
        <form action="tambah.php" method="post">
            <div class="form-group">
                <label for="id_Motor">ID Motor</label>
                <input type="text" name="id_Motor" id="id_Motor" required>
            </div>

            <div class="form-group">
                <label for="Merk_Motor">Merk Motor</label>
                <input type="text" name="Merk_Motor" id="Merk_Motor" required>
            </div>

            <div class="form-group">
                <label for="Tahun_pembuatan">Tahun Pembuatan</label>
                <input type="text" name="Tahun_pembuatan" id="Tahun_pembuatan" required>
            </div>

            <div class="form-group">
                <label for="Harga_Sewa_perHari">Harga Sewa per Hari</label>
                <input type="text" name="Harga_Sewa_perHari" id="Harga_Sewa_perHari" required>
            </div>

            <div class="form-group">
                <label for="Status_motor">Status Motor</label>
                <select name="Status_motor" id="Status_motor" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Disewa">Disewa</option>
                </select>
            </div>

            <div style="margin-top: 20px;">
                <input type="submit" name="submit" value="Simpan" class="btn">
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>