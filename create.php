<?php
include_once("connect.php");
$title          = "";
$description    = "";
$ry             = "";
$language       = "";
$ol             = "";
$rd             = "";
$rr             = "";
$length         = "";
$rc             = "";
$rating         = "";
$sf             = "";
$sukses          = "";
$error           = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op = "";
}
if($op == 'edit'){
    $id = $_GET['id'];
    $sql_user  = "SELECT * FROM  film where film_id = '$id'";
    $q_user    = mysqli_query($connection,$sql_user);
    $data_user = mysqli_fetch_array($q_user);
    $title        = $data_user['title'];
    $description  = $data_user['description'];
    $ry           = $data_user['release_year'];
    $language     = $data_user['language_id'];
    $rd           = $data_user['rental_duration'];
    $rr           = $data_user['rental_rate'];
    $length       = $data_user['length'];
    $rc           = $data_user['replacement_cost'];
    $rating       = $data_user['rating'];
    $sf           = $data_user['special_features'];

    if($title == ''){
        $error = "Data Tidak Ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $title        = $_POST['title'];
    $description  = $_POST['description'];
    $ry           = $_POST['ry'];
    $language     = $_POST['language'];
    // $ol           = $_POST['ol1'];
    $rd           = $_POST['rd'];
    $rr           = $_POST['rr'];
    $length       = $_POST['length'];
    $rc           = $_POST['rc'];
    $rating       = $_POST['rating'];
    $sf           = $_POST['sf'];
    
    #cek input data kosong dan dimasukkan database
    if ($title && $description && $ry && $language && $rd && $rr && $length && $rc && $rating && $sf){
        if($op == 'edit'){
            $slq1 = "UPDATE film set title='$title',description='$description',release_year='$ry',language_id='$language',rental_duration='$rd',rental_rate='$rr',length='$length',replacement_cost='$rc',rating='$rating',special_features='$sf' where film_id='$id'";
            $q1   = mysqli_query($connection,$slq1);
            if($q1){
                $sukses = "Data Film Berhasil Diupdate";
            }else{
                $error = "Data Film Gagal Diupdate";
            }
        }else{
            $sql1 = "INSERT INTO film(title,description,release_year,language_id,rental_duration,rental_rate,length,replacement_cost,rating,special_features) VALUES('$title','$description','$ry','$language','$rd','$rr','$length','$rc','$rating','$sf')";
            $sql2 = mysqli_query($connection,$sql1);
            if($sql2){
                $sukses = "Film Baru Berhasil Dimasukkan";
            }else{
                $error = "Film Baru Gagal Dimasukkan!";
            }
        }
    }else{
        $error = "Silahkan Masukkan Semua Data";
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
    <link rel="stylesheet" href="style_create.css">
    <title>Data Film</title>
</head>
<body>
    <div class="mx-auto">
        <!-- create data -->
        <div class="card">
            <div class="card-header text-white bg-warning">
            Create / Edit Data Film
            </div>
            <div class="card-body">
                <?php
                // ------------form validation-------------------
                if($error){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php
                }
                ?>
                <?php
                if($sukses){
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                    header("refresh:1,url=create.php");                    
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo $description ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ry" class="col-sm-2 col-form-label">Release Year</label>
                        <div class="col-sm-6">
                            <input type="year" class="form-control" id="ry" name="ry" value="<?php echo $ry ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="language" class="col-sm-2 col-form-label">Language</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="language" id="language">
                                <option value="">- Choose Language -</option>
                                <option value="1" <?php if ($language == "1") echo "selected" ?>>1</option>
                                <option value="2" <?php if ($language == "2") echo "selected" ?>>2</option>
                                <option value="3" <?php if ($language == "3") echo "selected" ?>>3</option>
                                <option value="4" <?php if ($language == "4") echo "selected" ?>>4</option>
                                <option value="5" <?php if ($language == "5") echo "selected" ?>>5</option>
                                <option value="6" <?php if ($language == "6") echo "selected" ?>>6</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rd" class="col-sm-2 col-form-label">Rental Duration</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="rd" name="rd" value="<?php echo $rd ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rr" class="col-sm-2 col-form-label">Rental Rate</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="rr" name="rr" value="<?php echo $rr ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="length" class="col-sm-2 col-form-label">Length</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="length" name="length" value="<?php echo $length ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rc" class="col-sm-2 col-form-label">Replacement Cost</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="rc" name="rc" value="<?php echo $rc ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="rating" id="rating">
                                <option value="">- Choose Rating -</option>
                                <option value="G" <?php if ($rating == "G") echo "selected" ?>>G</option>
                                <option value="PG" <?php if ($rating == "PG") echo "selected" ?>>PG</option>
                                <option value="PG-13" <?php if ($rating == "PG-13") echo "selected" ?>>PG-13</option>
                                <option value="R" <?php if ($rating == "R") echo "selected" ?>>R</option>
                                <option value="NC-17" <?php if ($rating == "NC-17") echo "selected" ?>>NC-17</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sf" class="col-sm-2 col-form-label">Special Features</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="sf" id="sf">
                                <option value="">- Choose Rating -</option>
                                <option value="Trailers" <?php if ($sf == "Trailers") echo "selected" ?>>Trailers</option>
                                <option value="Commentaries" <?php if ($sf == "Commentaries") echo "selected" ?>>Commentaries</option>
                                <option value="Deleted Scenes" <?php if ($sf == "Deleted Scenes") echo "selected" ?>>Deleted Scenes</option>
                                <option value="Behind the Scenes" <?php if ($sf == "Behind The Scene") echo "selected" ?>>Behind The Scene</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
                        <a href="index.php"><button type="button" class="btn btn-success text-white">View Film</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>