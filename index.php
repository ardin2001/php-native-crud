<?php
include_once("connect.php");
if(isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op = "";
}
// ---------delete data film--------------
if($op == 'delete'){
    $id     = $_GET['id'];
    $sql1   = "DELETE FROM film WHERE film_id = '$id'";
    $q1     = mysqli_query($connection,$sql1);
    if($q1){
        $sukses = "Data Film Berhasil Dihapus";
    }else{
        $error = "Data Film Gagal Dihapus";
    }
}
// ----------edit data film-----------------
if($op == 'edit'){
    $op = $_GET['film_id'];
    $sql1 = "SELECT * FROM  film where film_id = '$id'";
    $q1   = mysqli_query($connection,$sql1);
    $data_user = mysqli_fetch_array($q1);
    $title        = $data_user['title'];
    $description  = $data_user['description'];
    $ry           = $data_user['ry'];
    $language     = $data_user['language'];
    $rd           = $data_user['rd'];
    $rr           = $data_user['rr'];
    $length       = $data_user['length'];
    $rc           = $data_user['rc'];
    $rating       = $data_user['rating'];
    $sf           = $data_user['sf'];

    if($id == ''){
        $error = "Data Tidak Ditemukan";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Data Film</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand">TABEL FILM FROM DB SAKILA</a>
        <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>
    </nav>
    <div class="mx-auto">
        <div class="create">
            <a href="create.php"><button type="button" class="btn btn-warning">Tambah Data Film</button></a>
        </div>
        <!-- read data -->
        <div class="card">
            <div class="card-header text-white bg-success">
            Data Film
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Release(y)</th>
                            <th scope="col">Language</th>
                            <!-- <th scope="col">Original Language</th> -->
                            <th scope="col">Rental Duration</th>
                            <th scope="col">Rental Rate</th>
                            <th scope="col">Length</th>
                            <th scope="col">Replacement Cost</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Special Features</th>
                            <th scope="col">Last Update</th>
                            <th scope="col">Opsi</th>
                        </tr>
                        <tbody>
                            <?php
                            if(isset($_GET['index'])){
                                $query1 = "SELECT * FROM film ORDER BY film_id DESC limit {$_GET['index']},10";
                            }else{
                                $query1 = "SELECT * FROM film ORDER BY film_id DESC limit 0,10";
                            }
                            
                            $query2 = mysqli_query($connection,$query1);
                            while($data_film = mysqli_fetch_array($query2)){
                                $id           = $data_film['film_id'];
                                $title        = $data_film['title'];
                                $description  = $data_film['description'];
                                $ry           = $data_film['release_year'];
                                $language     = $data_film['language_id'];
                                // $ol           = $data_film['original_language_id'];
                                $rd           = $data_film['rental_duration'];
                                $rr           = $data_film['rental_rate'];
                                $length       = $data_film['length'];
                                $rc           = $data_film['replacement_cost'];
                                $rating       = $data_film['rating'];
                                $sf           = $data_film['special_features'];
                                $lu           = $data_film['last_update'];
                                
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $id ?></th>
                                    <td scope="row"><?php echo $title ?></td>
                                    <td scope="row"><?php echo $description ?></td>
                                    <td scope="row"><?php echo $ry ?></td>
                                    <td scope="row"><?php echo $language ?></td>
                                    <td scope="row"><?php echo $rd ?></td>
                                    <td scope="row"><?php echo $rr ?></td>
                                    <td scope="row"><?php echo $length ?></td>
                                    <td scope="row"><?php echo $rc ?></td>
                                    <td scope="row"><?php echo $rating ?></td>
                                    <td scope="row"><?php echo $sf ?></td>
                                    <td scope="row"><?php echo $lu ?></td>
                                    <td scope="row">
                                        <a href="create.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                        <!-- validasi hapus data -->
                                        <a href="index.php?op=delete&id=<?php echo $id?>"onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                                <?php
                            }
                             ?>
                        </tbody>
                    <thead>
                </table>           
                </form>
                <?php
                    $sql2 = "SELECT COUNT(*) AS total FROM film";
                    $result = $connection->query($sql2);
                    $row = $result->fetch_assoc();
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="?index=<?php echo 0?>" style="color: white; background-color: blue">First</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?index=<?php if(isset($_GET['index'])) {if($_GET['index'] >9) echo $_GET['index']-10; else echo 0;} else echo 0; ?>">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?index=<?php if(isset($_GET['index'])) {if($_GET['index'] < $row['total']-10) echo $_GET['index']+10; else echo $_GET['index'];} else echo 10; ?>">Next</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?index=<?php echo $row['total']-10?>" style="color: white; background-color: green">Last</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>