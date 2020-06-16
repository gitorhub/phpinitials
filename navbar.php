

<div class="d-flex justify-content-around">
<?php if($_SERVER['PHP_SELF']=='/web/Personel/index.php'){
  
echo '<div class="col-3 d-flex justify-content-center">
<a  class="form-control btn text-secondary font-weight-bold border border-danger border-top-0 border-left-0 border-right-0" > &lt&lt PERSONEL SORUSU</a>

</div>';
}else{
  echo '<div class="col-3 d-flex justify-content-center">
<a href="/web/Personel" class="form-control btn text-danger font-weight-bold border border-danger border-top-0 border-left-0 border-right-0" disabled> &lt&lt PERSONEL SORUSU</a>

</div>';

}
 ?>



<?php if($_SERVER['PHP_SELF']=='/web/Trigonometri/index.php'){
echo '<div class="col-3 d-flex justify-content-center">
<a class="form-control btn text-secondary font-weight-bold border border-success border-top-0 border-left-0 border-right-0">TRİGONOMETRİ SORUSU &gt&gt</a>
</div>';
}else{
  echo '<div class="col-3 d-flex justify-content-center">
<a href="/web/Trigonometri" class="form-control btn text-success font-weight-bold border border-success border-top-0 border-left-0 border-right-0">TRİGONOMETRİ SORUSU &gt&gt</a>
</div>';
};?>
</div>