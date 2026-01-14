<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah User
    </button>
    <div class="row">
        <div class="table-responsive" id="users_data">

        </div>
        <!-- Akhir Modal Hapus -->

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" name="username" placeholder="Tuliskan Username"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Tuliskan Password" required>
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

        <script>
            $(document).ready(function () {
                load_data();
                function load_data(hlm) {
                    $.ajax({
                        url: "users_data.php",
                        method: "POST",
                        data: {
                            hlm: hlm
                        },
                        success: function (data) {
                            $('#users_data').html(data);
                        }
                    })
                }
                $(document).on('click', '.halaman', function () {
                    var hlm = $(this).attr("id");
                    load_data(hlm);
                });
            });
        </script>

        <?php
        include "upload_foto.php";

        //jika tombol simpan diklik
        if (isset($_POST['simpan'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $foto = '';
            $nama_foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : '';

            //jika ada file yang dikirim  
            if ($nama_foto != '') {
                $cek_upload = upload_foto($_FILES["foto"]);

                if ($cek_upload['status']) {
                    $foto = $cek_upload['message'];
                } else {
                    echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=users';
            </script>";
                    die;
                }
            }

            //cek apakah ada id yang dikirimkan dari form
            if (isset($_POST['id'])) {
                //jika ada id, lakukan update data dengan id tersebut
                $id = $_POST['id'];

                if ($nama_foto == '') {
                    //jika tidak ganti foto
                    $foto = isset($_POST['foto_lama']) ? $_POST['foto_lama'] : '';
                } else {
                    //jika ganti foto, hapus foto lama
                    if (isset($_POST['foto_lama']) && $_POST['foto_lama'] != '' && file_exists("img/" . $_POST['foto_lama'])) {
                        unlink("img/" . $_POST['foto_lama']);
                    }
                }

                // Check if password is being changed
                if (isset($_POST['password']) && $_POST['password'] != '') {
                    $password = md5($_POST['password']);
                    $stmt = $conn->prepare("UPDATE user 
                                    SET 
                                    user =?,
                                    password =?,
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
                //jika tidak ada id, lakukan insert data baru
                $stmt = $conn->prepare("INSERT INTO user (user, password, foto)
                                VALUES (?,?,?)");

                $stmt->bind_param("sss", $username, $password, $foto);
                $simpan = $stmt->execute();
            }

            if ($simpan) {
                echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=users';
        </script>";
            } else {
                echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=users';
        </script>";
            }

            $stmt->close();
            $conn->close();
        }

        //jika tombol hapus diklik
        if (isset($_POST['hapus'])) {
            $id = $_POST['id'];
            $foto = $_POST['foto'];

            if ($foto != '' && file_exists("img/" . $foto)) {
                //hapus file foto
                unlink("img/" . $foto);
            }

            $stmt = $conn->prepare("DELETE FROM user WHERE id =?");

            $stmt->bind_param("i", $id);
            $hapus = $stmt->execute();

            if ($hapus) {
                echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=users';
        </script>";
            } else {
                echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=users';
        </script>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>