<?php
 include("configBP.php");
 
 session_start();
 otvoriBP();
 
 
 
 
 
 if(isset($_POST['kor_ime'])) {
  if (isset($_POST['tip'])) {
   $tip = $_POST['tip'];
  } else  {
   $tip = 2;
  } 
  $kor_ime = $_POST['kor_ime'];
  $ime = $_POST['ime'];
  $prezime = $_POST['prezime'];
  $lozinka = $_POST['lozinka'];
  $email = $_POST['email'];
  $slika = $_POST['slika'];
  
  $id = $_POST['novi'];
  
  if ($id == 0) {
  
   $sql = "INSERT INTO korisnik 
   (tip_id, korisnicko_ime, lozinka, ime, prezime, email, slika)
   VALUES
   ($tip, '$kor_ime', '$lozinka', '$ime', '$prezime', '$email', '$slika');
   ";
  } else {
   $sql = "UPDATE korisnik SET      
    ime='$ime',
    prezime='$prezime',
    lozinka='$lozinka',
    email = '$email',
    slika = '$slika'
    WHERE korisnik_id = '$id'
   ";
  }  
  header("Location: korisnici.php");
  
  
  izvrsiBP($sql);
  
  
 }
 include("header.php");
 
 if(isset($_GET['korisnik'])) {
  $id = $_GET['korisnik'];
  if ($aktivni_korisnik_tip==2) {
   $id = $_SESSION["aktivni_korisnik_id"]; //osiguravamo se da običan korisnik ne može uređivati nikoga osim sebe
  }
  $sql = "SELECT * FROM korisnik WHERE korisnik_id='$id'";
  
  otvoriBP();
  $rs = izvrsiBP($sql);
  list($id, $tip, $kor_ime,$lozinka,$ime,$prezime,$email, $slika) = 
  mysql_fetch_array($rs);
  
  
 } else {
  $kor_ime = "";
  $ime = "";
  $tip = 2;
  $prezime = "";
  $lozinka = "";
  $email = "";
  $slika = "";
 }
 ?>


  <form method="post" action="korisnik.php">
   <div>
   <input type="hidden" name="novi" value="<?php echo $id?>"/>
   
   <table>
    <tr>
     <td><label for="kor_ime">Korisničko ime:</label></td>
     <td><input type="text" name="kor_ime" id="kor_ime"
      <?php 
       if (isset($id)) {
        echo "readonly='readonly'";
       } 
      ?>
      value="<?php echo $kor_ime?>"/></td>
    </tr>
    
    <tr>
     <td><label for="ime">Ime:</label></td>
     <td><input type="text" name="ime" id="ime" value="<?php echo $ime?>"/></td>
    </tr>
    
    <tr>
     <td><label for="prezime">Prezime:</label></td>
     <td><input type="text" name="prezime" id="prezime" value="<?php echo $prezime?>"/></td>
    </tr>
    
    <tr>
     <td><label for="lozinka" >Lozinka:</label></td>
     <td><input type="text" name="lozinka" id="lozinka" value="<?php echo $lozinka?>"/></td>
    </tr>
    
    <?php 
     if($_SESSION['aktivni_korisnik_tip'] == 0) {
      ?>
       <tr>
        <td>Tip korisnika:</td>
        <td><select name="tip">
         <option value="0" <?php if ($tip == 0) echo "selected='selected'";?>>Administrator</option>
         <option value="1" <?php if ($tip == 1) echo "selected='selected'";?>>Voditelj</option>
         <option value="2" <?php if ($tip == 2) echo "selected='selected'";?>>Konobar</option>
        </select></td>
       </tr>
      <?php
     }
     ?>
    <tr>
     <td><label for="email">email:</label></td>
     <td><input type="text" name="email" id="email" value="<?php echo $email?>"/></td>
    </tr>
    
    <tr>
     <td><label for="slika">Slika:</label></td>
     <td><input type="text" name="slika" id="slika" value="<?php echo $slika?>" /></td>
    </tr>
    <tr>
     <td colspan="2"><input type="submit" value="Pošalji"/></td>
    </tr>
   </table>
   </div>
  </form>  
<?php

 zatvoriBP();
 include("footer.php");

?>