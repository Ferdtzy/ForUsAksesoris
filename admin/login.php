<!-- Melakukan koneksi ke database forusaksesoris-->
<?php
//Nama File: [login.php]
//Deskripsi: Untuk menampilkan halaman pembelian untuk melihat data pembelian pelanggan
//Dibuat oleh: [Ferdian Baihaqi] - NIM: [3312411029]
//Tanggal: [24-12-2024]

session_start();
//skrip koneksi
$koneksi = new mysqli("localhost", "root", "", "forusaksesoris");
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> forusaksesoris : Login</h2>
               
                <h5>( Login yourself to get access )</h5>
                 <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Enter Details To Login </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" name="user" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control"  name="pass" />
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" /> Remember me
                                            </label>
                                            <span class="pull-right">
                                                   <a href="#" >Forget password ? </a> 
                                            </span>
                                        </div>
                                     
                                     <button class="btn btn-primary" name ="login">Login</button>
                                    <hr />
                                    Not register ? <a href="registeration.html" >click here </a> 
                                    </form>
                                    
                                    <?php 
                                    //Fungsi: Mengecek apakah form login telah dikirim (tombol login ditekan).
                                    if (isset($_POST['login']))
                                    {
                                        //mengambil data dari database,
                                        //Mencocokkan kolom username dan password di tabel admin dengan nilai yang diinputkan ($_POST[user] dan $_POST[pass]).
                                       $ambil = $koneksi->query("SELECT * FROM admin WHERE username = '$_POST[user]' AND password = '$_POST[pass]'");
                                       //num_rows: Properti dari hasil query yang menunjukkan jumlah baris yang ditemukan.
                                       $yangcocok = $ambil->num_rows;
                                       //Jika jumlah baris ($yangcocok) adalah 1, berarti terdapat satu akun yang cocok.
                                       if ($yangcocok==1)
                                       {
                                            //fetch_assoc(): Mengambil data hasil query dalam bentuk array asosiatif dan menyimpannya di $_SESSION['admin'] untuk digunakan selama sesi login.
                                            $_SESSION['admin']=$ambil->fetch_assoc();
                                            echo "<div class='alert alert-info'>Login sukses</div>";
                                            echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                                       }
                                       //Jika tidak ada data yang cocok ($yangcocok bukan 1), maka login dianggap gagal.
                                       else
                                       {
                                        echo "<div class='alert alert-danger'>Login gagal</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                       }
                                    }
                                    ?>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
