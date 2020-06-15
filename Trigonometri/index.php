<?php include "db.php" ?>
<?php include "../navbar.php" ;?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>İnternet Programlama Final Soruları</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>


  <div class="container">
    <div class="col-12">
      <h2 class="text-center text-muted p-2">İnternet Programlama Final Soru-2</h2>

    </div>

    <div class="col-12 d-flex mt-5">
      <div class="col-4">
        <?php 
                $sql="SELECT * FROM DeğerTablo";
                $sql_result=mysqli_query($conn, $sql);
                if(mysqli_num_rows($sql_result)>360){
					echo '<form>
						  <input type="button" value="Veri Tabanına Aktar" class="btn btn-info form-control" name="trigonometri-aktar" disabled>
						</form>';
					echo '<div class="alert alert-info text-center" role="alert">
							Sayılar veritabanına aktarılmış. Verileri çekebilirsiniz.
						  </div>';    
                }else{
					echo '<form action="index.php" method="post">
						  <input type="submit" value="Veri Tabanına Aktar" class="btn btn-info form-control" name="trigonometri-aktar">
						</form>';
					echo ' <div class="alert alert-info text-center" role="alert">
                  0 İle 360 arasındaki sayıları, sayıların sinüs ve kosinüslerini veri tabanına aktar.
                </div>';
                  if(isset($_POST['trigonometri-aktar'])){
                  for($i=0; $i<=360; $i++){
                    $Açı=$i;
                    $Sinüs=sin(deg2rad($i));
                    $Kosinüs=cos(deg2rad($i));
                  
                    $sql="INSERT INTO DeğerTablo (Açı, Sinüs, Kosinüs) VALUES ($Açı,$Sinüs, $Kosinüs)";
                    $sql_result=mysqli_query($conn, $sql);
                  }
                  header("location:index.php");
                  }

                }

              ?>
      </div>

      <div class="col-4">
        <form action="index.php" method="post">
          <input type="submit" value="Veri Tabanından Çek" class="btn btn-success form-control" name="trigonometri-çek">
        </form>
        <div class="alert alert-success text-center" role="alert">
          0 İle 360 arasındaki sayıları, sayıların sinüs ve kosinüslerini veri tabanından çeker.
        </div>
      </div>

      <div class="col-4">
        <form action="index.php" method="post">
          <input type="submit" value="Veri Tabanını Temizle" class="btn btn-danger form-control" name="trigonometri-sil">
        </form>
        <div class="alert alert-danger text-center" role="alert">
          Veritabanında bulunan tüm verileri siler
        </div>
      </div>

    </div>


    <!-- Output of database -->
    <hr class="border border-dark">
    <div class="d-flex justify-content-center">
      
    <div class="col-8 text-center">
		<div class="d-flex">
          <div class="col text-info h1"> Açı</div>
          <div class="col text-warning h1"> Sinüs</div>
          <div class="col text-primary h1"> Kosinüs </div>
    </div>
      <?php 
      if(isset($_POST['trigonometri-çek'])){
        $sql="SELECT * FROM DeğerTablo";
          $sql_result=mysqli_query($conn, $sql);
          mysqli_num_rows($sql_result);
        
          while($Değer_Tablo=mysqli_fetch_assoc($sql_result)){
            $Açı=$Değer_Tablo["Açı"];
            $Sinüs=$Değer_Tablo["Sinüs"];
            $Kosinüs=$Değer_Tablo["Kosinüs"];?>
      <ul class="list-group">
        <li class="list-group-item d-flex p-0">
          <div class="col text-info font-weight-bold"> <?php echo htmlspecialchars($Açı) ?></div>
          <div class="col text-warning font-weight-bold"> <?php echo htmlspecialchars($Sinüs) ?></div>
          <div class="col text-primary font-weight-bold">  <?php echo htmlspecialchars($Kosinüs) ?></div>
        </li>
      </ul>

      <?php } } ?>
    </div>

    </div>


  </div>
  <?php 
  if(isset($_POST["trigonometri-sil"])){
    $sql_del="DELETE FROM DeğerTablo WHERE Açı>=0";
    $sql_del_result=mysqli_query($conn, $sql_del);
    header("location:index.php");
  }

  ?>

</body>

</html>