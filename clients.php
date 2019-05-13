<?php include_once('elements/top.php'); ?>

<!DOCTYPE html>
<html lang="de" dir="ltr" class="grid-template">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clients | Impressum & Datenschutz stuff</title>

    <link rel="stylesheet" href="./public/css/style.min.css?v=<?=date("YmdGis", filemtime('./public/css/style.min.css'))?>">
  </head>
  <body class="clients">

    <?php require('elements/nav.php'); ?>

    <header>
      <div class="search-wrap">
        <input id="search" type="text" class="search" placeholder="search">
      </div>
    </header>

    <?php require('elements/user.php'); ?>

    <main>

      <?php
        $rechtUpdate = '2019-04-28 12:24:03';
        $rechtUpdateTime = strtotime($rechtUpdate);
      ?>

      <?php
        $sql = "SELECT * FROM clients";
        $result = $con->query($sql);

        if ($result->rowCount() > 0) {
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $clientId = $row['id'];
            $clientName = $row['name'];
            $clientLegalLink = $row['legalLink'];
            $clientCreatedAt = $row['createdAt'];
            $clientUpdatedAt = $row['updatedAt'];

            $outdatedImp = '';
            $outdatedDat = '';

            $resultImp = $con->prepare("SELECT * FROM impressum WHERE clientId = $clientId ORDER BY updatedAt LIMIT 1");
            $resultImp->execute();
            $rowImp = $resultImp->fetch();
            if ($rowImp) {
              $impressumUpdateTime = strtotime($rowImp['updatedAt']);
              $impressumUpdate = date('d.m.Y H:i', $impressumUpdateTime);
            } else {
              $impressumUpdate = '-';
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

            if ($rowImp && $impressumUpdateTime < $rechtUpdateTime) {
              $outdatedImp = 'outdated';
            }
            if ($rowDat && $datenschutzUpdateTime < $rechtUpdateTime) {
              $outdatedDat = 'outdated';
            }
            ?>
              <section class="box box--client" client-id="<?=$clientId?>">
                <div class="box__wrapper">
                  <div class="box__header">
                    <div class="box__header__title">
                      <h1><?=$clientName?></h1>
                      <a href="<?=$clientLegalLink?>" target="_blank" class="open-extern">
                        <i class="material-icons">launch</i>
                      </a>
                      <?php
                        if ($impressumUpdate == '-' || $datenschutzUpdate == '-') {
                          ?>
                          <i class="material-icons error" data-tooltip="missing" data-tooltip-position="right">warning</i>
                          <?php
                        } else if ($outdatedImp == 'outdated' || $outdatedDat == 'outdated') {
                          ?>
                          <i class="material-icons warning" data-tooltip="not up to date" data-tooltip-position="right">error_outline</i>
                          <?php
                        } else {
                          ?>
                          <i class="material-icons success" data-tooltip="up to date" data-tooltip-position="right">check</i>
                          <?php
                        }
                      ?>
                    </div>
                    <div class="delete-client" client-id="<?=$clientId?>" data-tooltip="delete client">
                      <a href="#!">
                        <i class="material-icons">delete</i>
                      </a>
                    </div>
                  </div>

                  <div class="box__content">
                    <div class="entry">
                      <div class="entry__title">
                        <a href="#!">
                          Impresum
                        </a>
                      </div>
                      <div class="entry__date <?=$outdatedImp?>">
                        <?=$impressumUpdate?>
                      </div>
                      <?php
                        if ($impressumUpdate == '-') {
                          ?>
                            <div class="entry__control--add control" data-tooltip="add Impressum">
                              <a href="impressum?id=<?=$clientId?>">
                                <i class="material-icons success">add</i>
                              </a>
                            </div>
                          <?php
                        } else {
                          ?>
                            <div class="entry__control--edit control">
                              <a href="impressum?id=<?=$clientId?>">
                                <i class="material-icons">edit</i>
                              </a>
                            </div>
                            <div class="entry__control--delete control" data-tooltip="delete Impressum">
                              <a href="#!">
                                <i class="material-icons">delete</i>
                              </a>
                            </div>
                          <?php
                        }
                      ?>
                    </div>

                    <div class="entry">
                      <div class="entry__title">
                        <a href="#!">
                          Datenschutz
                        </a>
                      </div>
                      <div class="entry__date <?=$outdatedDat?>">
                        <?=$datenschutzUpdate?>
                      </div>
                      <?php
                        if ($datenschutzUpdate == '-') {
                          ?>
                            <div class="entry__control--add control" data-tooltip="add Datenschutz">
                              <a href="datenschutz.php?id=<?=$clientId?>">
                                <i class="material-icons success">add</i>
                              </a>
                            </div>
                          <?php
                        } else {
                          ?>
                            <div class="entry__control--edit control">
                              <a href="datenschutz.php?id=<?=$clientId?>">
                                <i class="material-icons">edit</i>
                              </a>
                            </div>
                            <div class="entry__control--delete control" data-tooltip="delete Datenschutz">
                              <a href="#!">
                                <i class="material-icons">delete</i>
                              </a>
                            </div>
                          <?php
                        }
                      ?>
                    </div>
                  </div>
                </div>
              </section>
            <?php
          }
        } else {
          ?>
            <section class="box">
              <div class="box__empty">
                <span>No clients found</span>
                <a href="#!" class="btn">create new</a>
              </div>
            </section>
          <?php
        }
      ?>


      <a href="#!" class="add_client btn" data-tooltip="add client" data-tooltip-position="top">
        <i class="material-icons success">add</i>
      </a>

    </main>

    <div class="sidebar">
      <div class="box">
        Last update: <span><?=date('d.m.Y H:i', $rechtUpdateTime)?></span>
      </div>

      <?php require('elements/log.php'); ?>
    </div>

    <?php require('elements/scripts.php'); ?>
  </body>
</html>
