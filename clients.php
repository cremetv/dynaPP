<?php include_once('top.php'); ?>

<!DOCTYPE html>
<html lang="de" dir="ltr" class="grid-template">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clients | Impressum & Datenschutz stuff</title>

    <link rel="stylesheet" href="./public/css/style.min.css?v=<?=date("YmdGis", filemtime('./public/css/style.min.css'))?>">
  </head>
  <body>

    <?php require('elements/nav.php'); ?>

    <header>
      <div class="search-wrap">
        <input type="text" class="search" placeholder="search">
      </div>
    </header>

    <div class="user">
      <div class="user__image">
        <img src="https://images.unsplash.com/photo-1556457617-2963058200ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="">
      </div>

      <div class="user__name">
        <a href="#!">
          <span>
            John Doe
          </span>

          <i class="material-icons">keyboard_arrow_down</i>
        </a>
      </div>
    </div>

    <main>

    </main>

    <div class="sidebar">

    </div>

    <script src="./public/js/main.min.js?v=<?=date("YmdGis", filemtime('./public/js/main.min.js'))?>"></script>
  </body>
</html>
