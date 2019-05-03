<?php include_once('elements/top.php'); ?>

<?php
if (!isset($_GET['id'])) {
  // redirect
} else {
  $clientId = $_GET['id'];
}
?>
<?php

?>
<!DOCTYPE html>
<html lang="de" dir="ltr" class="grid-template">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clients | Impressum & Datenschutz stuff</title>

    <link rel="stylesheet" href="./public/css/style.min.css?v=<?=date("YmdGis", filemtime('./public/css/style.min.css'))?>">
  </head>
  <body class="impressum">

    <?php require('elements/nav.php'); ?>

    <header>
      <div class="search-wrap">
        <input id="search" type="text" class="search" placeholder="search">
      </div>
    </header>

    <?php require('elements/user.php'); ?>

    <main>
      impressum
    </main>

    <div class="sidebar">

    </div>



    <?php require('elements/scripts.php'); ?>
  </body>
</html>
