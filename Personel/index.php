<?php include "db.php" ;?>
<?php include "../navbar.php" ;?>


<?php 
  if(isset($_POST['submit_del'])){
    $Personel_No_del=$_POST['del_data'];

    $sql_del="DELETE FROM `pertablo` WHERE Personel_No='$Personel_No_del'";
    $sql_del_result=mysqli_query($conn, $sql_del);

    header("location:index.php");
  }
 ?> 

<?php 


if(isset($_POST["Personel_Submit"])){
$Adı= ucfirst(mysqli_real_escape_string($conn,$_POST['Adı']));
$Soyadı=ucfirst(mysqli_real_escape_string($conn,$_POST['Soyadı']));
$Kadro_Birimi=mysqli_real_escape_string($conn,$_POST['Kadro_Birimi']);
$Başlama_Tarihi=mysqli_real_escape_string($conn,$_POST['Başlama_Tarihi']);


// Çalışma_Süresi kısmı
$Bugün=getdate()['year'];
$başlama_timestamp=strtotime($Başlama_Tarihi);
$başlama_sene=date('Y', $başlama_timestamp);
$Çalışma_Süresi=($Bugün-$başlama_sene);



// // Personel Numarası kısmı
$prefix=mb_strtoupper(mb_substr($Kadro_Birimi,0,3, "UTF-8" ), "UTF-8" );
$Personel_No=$prefix.str_pad(1, 3, "0", STR_PAD_LEFT);

  $sql_kadro="SELECT Personel_No FROM `pertablo` WHERE Kadro_Birimi='$Kadro_Birimi' ORDER BY Personel_No DESC LIMIT 1";
   $sql_kadro_result=mysqli_query($conn,$sql_kadro);
  if($sql_kadro_result){
       while($row=mysqli_fetch_assoc($sql_kadro_result)){
         $last_no= $row['Personel_No'];
         $last_no_number=intval(substr($last_no,-3));
         $new_no=$last_no_number+1;
         $prefix=mb_strtoupper(mb_substr($Kadro_Birimi,0,3, "UTF-8" ), "UTF-8" );
       $Personel_No=$prefix.str_pad($new_no, 3, "0", STR_PAD_LEFT);
     }
   }


  //  veritabanına kayıt kısmı
$sql_add="INSERT INTO `pertablo`(`Personel_No`, `Adı`, `Soyadı`, `Kadro_Birimi`, `Başlama_Tarihi`, `Çalışma_Süresi`) VALUES ('$Personel_No','$Adı','$Soyadı','$Kadro_Birimi','$Başlama_Tarihi','$Çalışma_Süresi')";
$sql_add_result=mysqli_query($conn, $sql_add);
  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <title>Personel Veritabanı</title>
  <style>
    .bg-muhsin{
      background:linear-gradient(to right, white, #13aff0, #13aff0,#13aff0,white);
    }
  </style>

</head>

<body>
  <div class="container">

  <div class="col-12">
      <h2 class="text-center text-muted">İnternet Programlama Final Soru-1</h2>


    </div>
  </div>
  <div class="container bg-muhsin d-flex justify-content-center mb-5">
    
    <form action="" method="post" class="col-5">
      <div class="form-group">
        <label for="Adı">Adı</label>
        <input type="text" class="form-control" name="Adı" id="Adı" >
      </div>
      <div class="form-group">
        <label for="Soyadı">Soyadı</label>
        <input type="text" class="form-control" name="Soyadı" id="Soyadı" >
      </div>
      <div class="form-group">
        <label for="Kadro_Birimi">Kadro Birimi</label>
        <select class="custom-select" name="Kadro_Birimi" id="Kadro_Birimi" >
          <option selected disabled> (Kadro Birimi Seçiniz)</option>
          <option>Teknik Hizmetler</option>
          <option>İdari Hizmetler</option>
          <option>Eğitim Hizmetleri</option>
          <option>Dış İlişkiler</option>
          <option>Halkla İlişkiler</option>
        </select>
      </div>
      <div class="form-group">
        <label for="Başlama_Tarihi">Başlama Tarihi</label>
        <input type="date" class="form-control" name="Başlama_Tarihi" id="Başlama_Tarihi" >
      </div>

      <div class="form-group">
        <input type="submit" class="btn btn-warning form-control" name="Personel_Submit" value="Ekle">
      </div>
    </form>

  </div>
  <table class="table">
    <thead >
      <tr class="row">
        <th class="col text-center bg-dark text-white">Personel No</th>
        <th class="col text-center bg-info text-white">Adı</th>
        <th class="col text-center bg-secondary text-white">Soyadı</th>
        <th class="col text-center bg-success text-white">Kadro Birimi</th>
        <th class="col text-center bg-warning text-white">Başlama Tarihi</th>
        <th class="col text-center bg-primary text-white">Çalışma Süresi</th>
        <th class="col text-center bg-danger text-white">Sırayı Sil</th>

      </tr>
    </thead>
    <?php 
      $sql_get="SELECT * FROM `pertablo`";
      $sql_get_result=mysqli_query($conn,$sql_get);
      while($row=mysqli_fetch_assoc($sql_get_result)){
      $Personel_No=$row["Personel_No"];
      $Adı=$row["Adı"];
      $Soyadı=$row["Soyadı"];
      $Kadro_Birimi=$row["Kadro_Birimi"];
      $Başlama_Tarihi=$row["Başlama_Tarihi"];
      $Çalışma_Süresi=$row["Çalışma_Süresi"];

        ?>

    <tbody>
      <tr class="row font-weight-bold">
        <td  class="col text-center text-dark border"><?php echo htmlspecialchars($Personel_No); ?></td>
        <td class="col text-center text-info border"><?php echo htmlspecialchars($Adı); ?></td>
        <td class="col text-center text-secondary border"><?php echo htmlspecialchars($Soyadı); ?></td>
        <td class="col text-center text-success border"><?php echo htmlspecialchars($Kadro_Birimi); ?></td>
        <td class="col text-center text-warning border"><?php echo htmlspecialchars($Başlama_Tarihi); ?></td>
        <td class="col text-center text-primary border"><?php echo htmlspecialchars($Çalışma_Süresi); ?></td>
        <td class="col text-center text-danger border">
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <input type="hidden" name="del_data" value="<?php echo htmlspecialchars($Personel_No); ?>">
            <input type="submit" value="X" name="submit_del" class="bg-danger  text-white border-white">
          </form>

        </td>
      </tr>

    </tbody>
    <?php }; ?>
  </table>


</body>

</html>