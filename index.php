<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Siswa</title>
</head>
<body>

<div class="main d-flex flex-column justify-content-center align-items-center">
    <div class="login-box p-5 shadow">
        <h1 style="text-align:center">MASUKKAN DATA SISWA</h1>
        <form method="POST" action="">
            <div class="form-floating mb-3">
                <input type="text" name="nama" class="form-control" id="floatingInput" required>
                <label for="floatingInput">Nama</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="nis" class="form-control" id="nis" required>
                <label for="nis" class="form-label">NIS</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="rayon" class="form-control" id="rayon" required>
                <label for="rayon" class="form-label">Rayon</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="kirim" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger"><a href="?reset" style="color:white; text-decoration:none;">Reset</a></button>
            </div>
        </form>
    </div>
    <div>
        <?php 
        session_start();
        
        if (!isset($_SESSION['dataSiswa'])) {
            $_SESSION['dataSiswa'] = [];
        }

        if (isset($_GET['reset'])) {
            $_SESSION['dataSiswa'] = [];
        }

        if (isset($_GET['hapus'])) {
            $index = $_GET['hapus'];
            unset($_SESSION['dataSiswa'][$index]);
        }

        if (isset($_POST['kirim'])) {
            if (!empty($_POST['nama']) && !empty($_POST['nis']) && !empty($_POST['rayon'])) {
                $data = [
                    'nama' => $_POST['nama'],
                    'nis' => $_POST['nis'],
                    'rayon' => $_POST['rayon'],
                ];
                array_push($_SESSION['dataSiswa'], $data);
            }
        }

        if (!empty($_SESSION['dataSiswa'])) {
            echo '<table class="table">';
            echo '<tr>';
            echo '<th>NAMA</th>';
            echo '<th>NIS</th>';
            echo '<th>RAYON</th>';
            echo '<th>HAPUS</th>';
            echo '</tr>';
        
            foreach ($_SESSION['dataSiswa'] as $index => $value) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($value['nama']) . '</td>';
                echo '<td>' . htmlspecialchars($value['nis']) . '</td>';
                echo '<td>' . htmlspecialchars($value['rayon']) . '</td>';
                echo '<td><a href="?hapus=' . $index . '">Hapus</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "ISI DATANYA TERLEBIH DAHULU!!";
        }
        ?>
    </div>
</div>

</body>
</html>
