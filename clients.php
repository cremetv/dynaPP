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

      <section class="box">
        <div class="box__header">
          <div class="box__header__title">
            <h1>John Doe</h1>
            <i class="material-icons success" data-tooltip="up to date" data-tooltip-position="right">check</i>
          </div>
          <div class="delete-client" data-tooltip="delete client">
            <i class="material-icons">delete</i>
          </div>
        </div>

        <div class="box__content">
          <div class="entry">
            <div class="entry__title">
              <a href="#!">
                Impresum
              </a>
            </div>
            <div class="entry__date">
              30.04.2019
            </div>
            <div class="entry__control--edit control">
              <i class="material-icons">edit</i>
            </div>
            <div class="entry__control--delete control" data-tooltip="delete Impressum">
              <i class="material-icons error">delete</i>
            </div>
          </div>

          <div class="entry">
            <div class="entry__title">
              <a href="#!">
                Datenschutz
              </a>
            </div>
            <div class="entry__date">
              28.04.2019
            </div>
            <div class="entry__control--edit control">
              <i class="material-icons">edit</i>
            </div>
            <div class="entry__control--delete control" data-tooltip="delete Datenschutz">
              <i class="material-icons error">delete</i>
            </div>
          </div>
        </div>
      </section>

    </main>

    <div class="sidebar">

    </div>

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
    <script src="./public/js/main.min.js?v=<?=date("YmdGis", filemtime('./public/js/main.min.js'))?>"></script>
  </body>
</html>
