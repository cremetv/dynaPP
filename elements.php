<?php include_once('elements/top.php'); ?>

<!DOCTYPE html>
<html lang="de" dir="ltr" class="grid-template">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Elements | Impressum & Datenschutz stuff</title>

    <link rel="stylesheet" href="./public/css/style.min.css?v=<?=date("YmdGis", filemtime('./public/css/style.min.css'))?>">
  </head>
  <body class="elements">

    <?php require('elements/nav.php'); ?>

    <header>
      <div class="search-wrap">
        <input id="search" type="text" class="search" placeholder="search">
      </div>
    </header>

    <?php require('elements/user.php'); ?>

    <main>


      <div class="element-wrap">
        <div class="element-wrap__title">Impressum</div>
      <?php
        $elName = '';
        $elCategory = '';
        $elSelectOption = '';
        $elType = '';
        $elTitle = '';
        $elDescription = '';
        $elHint = '';
        $sql = "SELECT * FROM elements WHERE site = 'impressum' AND custom = 0";
        $result = $con->query($sql);

        if ($result->rowCount() > 0) {
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $elName = $row['name'];
            $elTitle = $row['title'];
            $elDescription = $row['description'];
            $elHint = $row['hint'];

            ?>
            <div class="element">
              <div class="element__wrapper">
                <div class="element__name">
                  <?=$elName?>
                </div>
                <div class="element__title">
                  <?=$elTitle?>
                </div>
                <?php
                  if ($elDescription) {
                    ?>
                    <div class="element__description">
                      <?=$elDescription?>
                    </div>
                    <?php
                  }

                  if ($elHint) {
                    ?>
                    <div class="element__hint">
                      <div class="element__hint--icon">
                        <i class="material-icons info">error_outline</i>
                      </div>
                      <p>
                        <?=$elHint?>
                      </p>
                    </div>
                    <?php
                  }
                ?>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
            <div class="element">
              <div class="element__empty">
                <span>No element for impressum found</span>
                <a href="#!" class="btn">create new</a>
              </div>
            </div>
          <?php
        }
      ?>
      </div>


      <div class="element-wrap">
        <div class="element-wrap__title">Datenschutz</div>
      <?php
        $sql = "SELECT * FROM elements WHERE site = 'datenschutz' AND custom = 0";
        $result = $con->query($sql);

        if ($result->rowCount() > 0) {
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $elName = $row['name'];
            $elTitle = $row['title'];
            $elDescription = $row['description'];
            $elHint = $row['hint'];

            ?>
            <div class="element">
              <div class="element__wrapper">
                <div class="element__name">
                  <?=$elName?>
                </div>
                <div class="element__title">
                  <?=$elTitle?>
                </div>
                <div class="element__description">
                  <?=$elDescription?>
                </div>
                <?php
                  if ($elHint) {
                    ?>
                    <div class="element__hint">
                      <div class="element__hint--icon">
                        <i class="material-icons info">error_outline</i>
                      </div>
                      <p>
                        <?=$elHint?>
                      </p>
                    </div>
                    <?php
                  }
                ?>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
            <div class="element">
              <div class="element__empty">
                <span>No element for datenschutz found</span>
                <a href="#!" class="btn">create new</a>
              </div>
            </div>
          <?php
        }
      ?>
      </div>


      <div class="element-wrap">
        <div class="element-wrap__title">Custom</div>
      <?php
        $sql = "SELECT * FROM elements WHERE custom = 1";
        $result = $con->query($sql);

        if ($result->rowCount() > 0) {
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $elName = $row['name'];
            $elTitle = $row['title'];
            $elDescription = $row['description'];
            $elHint = $row['hint'];

            ?>
            <div class="element">
              <div class="element__wrapper">
                <div class="element__name">
                  <?=$elName?>
                </div>
                <div class="element__title">
                  <?=$elTitle?>
                </div>
                <div class="element__description">
                  <?=$elDescription?>
                </div>
                <?php
                  if ($elHint) {
                    ?>
                    <div class="element__hint">
                      <div class="element__hint--icon">
                        <i class="material-icons info">error_outline</i>
                      </div>
                      <p>
                        <?=$elHint?>
                      </p>
                    </div>
                    <?php
                  }
                ?>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
            <div class="element">
              <div class="element__empty">
                <span>No custom elements found</span>
                <a href="#!" class="btn">create new</a>
              </div>
            </div>
          <?php
        }
      ?>
      </div>

    </main>

    <div class="sidebar">

    </div>



    <?php require('elements/scripts.php'); ?>
  </body>
</html>
