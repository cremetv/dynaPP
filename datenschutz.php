<?php include_once('elements/top.php'); ?>

<?php
  $clientId = $_GET['id'];
  if (!isset($clientId) || $clientId == '') {
    header("Location: clients.php");
  }


  $rechtUpdate = '2019-04-28 12:24:03';
  $rechtUpdateTime = strtotime($rechtUpdate);
?>
<?php
  $sql = "SELECT * FROM clients WHERE id = $clientId LIMIT 1";
  $result = $con->query($sql);

  if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $clientName = $row['name'];
      $clientLegalLink = $row['legalLink'];
    }
  }


  $clientElements = [];
  $sql = "SELECT * FROM datenschutz WHERE clientId = $clientId";
  $result = $con->query($sql);
  if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      array_push($clientElements, $row['elementId']);
    }
  }


  $resultDat = $con->prepare("SELECT * FROM datenschutz WHERE clientId = $clientId ORDER BY updatedAt DESC LIMIT 1");
  $resultDat->execute();
  $rowDat = $resultDat->fetch();
  if ($rowDat) {
    $datenschutzUpdateTime = strtotime($rowDat['updatedAt']);
    $datenschutzUpdate = date('d.m.Y H:i', $datenschutzUpdateTime);
  } else {
    $datenschutzUpdate = '-';
  }

?>
<!DOCTYPE html>
<html lang="de" dir="ltr" class="grid-template">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clients | Impressum & Datenschutz stuff</title>

    <link rel="stylesheet" href="./public/css/style.min.css?v=<?=date("YmdGis", filemtime('./public/css/style.min.css'))?>">
  </head>
  <body class="datenschutz">

    <?php require('elements/nav.php'); ?>

    <header>
      <div class="search-wrap">
        <input id="search" type="text" class="search" placeholder="search">
      </div>
    </header>

    <?php require('elements/user.php'); ?>

    <main>

      <div class="list-title">
        Datenschutz - <?=$clientName?>
      </div>

      <form>

      <?php
      $sql = "SELECT * FROM elements WHERE site = 'datenschutz'";
      $result = $con->query($sql);

      if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $elId = $row['id'];
          $elName = $row['name'];
          $elRequired = $row['required'];
          $elTitle = $row['title'];
          $elDescription = $row['description'];
          $elCheckBoxText = $row['checkBoxText'];
          $elHint = $row['hint'];
          ?>
            <div class="box box--element">
              <div class="box__check__wrapper">
                <label class="checkbox">
                  <input type="checkbox" <?php if (in_array($elId, $clientElements) || $elRequired == 1) { echo 'checked'; } ?> <?php if ($elRequired == 1) {echo 'disabled';} ?>>
                  <span class="checkbox-label"></span>
                </label>
              </div>
              <div class="box__wrapper">
                <div class="box__header">
                  <div class="box__header__title">
                    <div class="box__header__title__name">
                      <?=$elName?>
                    </div>
                    <h1><?=$elTitle?></h1>
                  </div>
                  <?php
                    if ($elHint) {
                      ?>
                        <div class="action open-info">
                          <i class="material-icons info">error_outline</i>
                        </div>
                      <?php
                    }
                  ?>
                </div>
                <div class="box__content">
                  <div class="box__description">
                    <?=$elDescription?>
                    <?php
                      if ($elCheckBoxText) {
                        ?>
                        <div class="checkbox-text">
                          <?=$elCheckBoxText?>
                        </div>
                        <?php
                      }
                    ?>
                  </div>
                  <?php
                    if ($elHint) {
                      ?>
                        <div class="box__hint">
                          <div class="box__hint__wrap">
                            <div class="box__hint--icon">
                              <i class="material-icons info">error_outline</i>
                            </div>
                            <p>
                              <?=$elHint?>
                            </p>
                          </div>
                        </div>
                      <?php
                    }
                  ?>
                </div>
              </div>
            </div>
          <?php
        }
      } else {
        ?>
          <div class="element">
            <div class="element__empty">
              <span>No elements found</span>
              <a href="#!" class="btn">create new</a>
            </div>
          </div>
        <?php
      }
      ?>

      </form>

    </main>

    <div class="sidebar">
      <div class="box">
        Last update: <span><?=date('d.m.Y H:i', $rechtUpdateTime)?></span>
      </div>

      <div class="box">
        Client update: <span><?=$datenschutzUpdate?></span>
      </div>
    </div>



    <?php require('elements/scripts.php'); ?>
  </body>
</html>
