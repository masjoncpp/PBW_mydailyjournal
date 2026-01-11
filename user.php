<?php
include "upload_foto.php";

// Pagination settings
$items_per_page = 4;
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($page - 1) * $items_per_page;

// Count total records for pagination
$count_sql = "SELECT COUNT(*) as total FROM user";
$count_result = $conn->query($count_sql);
$total_records = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $items_per_page);
?>

<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah User
    </button>
    
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th class="w-25">Username</th>
                        <th class="w-25">Foto</th>
                        <th class="w-25">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM user ORDER BY id ASC LIMIT $offset, $items_per_page";
                    $hasil = $conn->query($sql);

                    $no = $offset + 1;
                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= $row["user"] ?></strong></td>
                            <td>
                                <?php
                                if ($row["foto"] != '') {
                                    if (file_exists('img/' . $row["foto"])) {
                                ?>
                                        <img src="img/<?= $row["foto"] ?>" width="80" class="rounded-circle">
                                <?php
                                    } else {
                                        echo '<span class="badge bg-secondary">No Photo</span>';
                                    }
                                } else {
                                    echo '<span class="badge bg-secondary">No Photo</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <!-- Awal Modal Edit -->
                                <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>"><i class="bi bi-pencil"></i></a>
                                <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label">Username</label>
                                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                        <input type="text" class="form-control" name="username" placeholder="Tuliskan Username" value="<?= $row["user"] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput2" class="form-label">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Password baru">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput3" class="form-label">Ganti Foto</label>
                                                        <input type="file" class="form-control" name="foto">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Foto Lama</label>
                                                        <?php
                                                        if ($row["foto"] != '' && file_exists('img/' . $row["foto"])) {
                                                        ?>
                                                            <br><img src="img/<?= $row["foto"] ?>" width="80" class="rounded-circle">
                                                        <?php
                                                        } else {
                                                            echo '<br><span class="badge bg-secondary">No Photo</span>';
                                                        }
                                                        ?>
                                                        <input type="hidden" name="foto_lama" value="<?= $row["foto"] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Edit -->

                                <!-- Awal Modal Hapus -->
                                <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>"><i class="bi bi-x-circle"></i></a>
                                <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus User</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput" class="form-label">Yakin akan menghapus user "<strong><?= $row["user"] ?></strong>"?</label>
                                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                        <input type="hidden" name="foto" value="<?= $row["foto"] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                                                    <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Hapus -->
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="admin.php?page=user&p=<?= $page - 1 ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="admin.php?page=user&p=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="admin.php?page=user&p=<?= $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Awal Modal Tambah-->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Tuliskan Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Tuliskan Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput3" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah-->

<?php
// jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $foto = '';
    $nama_foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';

    // jika ada file yang dikirim  
    if ($nama_foto != '') {
        $cek_upload = upload_foto($_FILES["foto"]);

        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=user';
            </script>";
            die;
        }
    }

    // cek apakah ada id yang dikirimkan dari form
    if (isset($_POST['id'])) {
        // jika ada id, lakukan update data dengan id tersebut
        $id = $_POST['id'];

        if ($nama_foto == '') {
            // jika tidak ganti foto
            $foto = $_POST['foto_lama'];
        } else {
            // jika ganti foto, hapus foto lama
            if ($_POST['foto_lama'] != '' && file_exists("img/" . $_POST['foto_lama'])) {
                unlink("img/" . $_POST['foto_lama']);
            }
        }

        // Cek apakah password diisi
        if (!empty($_POST['password'])) {
            $password = md5($_POST['password']);
            $stmt = $conn->prepare("UPDATE user 
                                    SET 
                                    user =?,
                                    password = ?,
                                    foto = ?
                                    WHERE id = ?");
            $stmt->bind_param("sssi", $username, $password, $foto, $id);
        } else {
            $stmt = $conn->prepare("UPDATE user 
                                    SET 
                                    user =?,
                                    foto = ?
                                    WHERE id = ?");
            $stmt->bind_param("ssi", $username, $foto, $id);
        }

        $simpan = $stmt->execute();
    } else {
        // jika tidak ada id, lakukan insert data baru
        $password = md5($_POST['password']);
        $stmt = $conn->prepare("INSERT INTO user (user, password, foto)
                                VALUES (?,?,?)");

        $stmt->bind_param("sss", $username, $password, $foto);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    $stmt->close();
}

// jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $foto = $_POST['foto'];

    if ($foto != '' && file_exists("img/" . $foto)) {
        // hapus file foto
        unlink("img/" . $foto);
    }

    $stmt = $conn->prepare("DELETE FROM user WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=user';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=user';
        </script>";
    }

    $stmt->close();
}
?>
