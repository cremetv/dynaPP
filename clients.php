<?php include_once('top.php'); ?>

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
            $clientAddress = $row['address'];
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
                            <a href="#!">
                              <i class="material-icons success">add</i>
                            </a>
                          </div>
                        <?php
                      } else {
                        ?>
                          <div class="entry__control--edit control">
                            <a href="#!">
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
                            <a href="#!">
                              <i class="material-icons success">add</i>
                            </a>
                          </div>
                        <?php
                      } else {
                        ?>
                          <div class="entry__control--edit control">
                            <a href="#!">
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

      <div class="log">
        <?php
          $sql = "SELECT * FROM log";
          $result = $con->query($sql);
          if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              $logId = $row['id'];
              $logUser = $row['user'];
              $logTime = $row['time'];
              $logClient = $row['client'];
              $logChanges = $row['changes'];
              $logElement = $row['element'];
              $logWas = $row['was'];
              $logIs = $row['isNow'];

              if ($logUser == 1) {
                $logUser = 'Ricardo';
              } else if ($logUser == 2) {
                $logUser = 'goodBoi';
              } else if ($logUser == 3) {
                $logUser = 'Dr. Phil';
              }

              $logTime = strtotime($logTime);
              $logTime = date('d.m.Y H:i', $logTime);
              // get changes description
              $sqlChanges = $con->prepare("SELECT * FROM changes WHERE name = '$logChanges' LIMIT 1");
              $sqlChanges->execute();
              $changeRow = $sqlChanges->fetch();
              if ($changeRow) {
                $changesDescription = $changeRow['description'];

                // get element info
                if ($logElement != null) {
                  $sqlEl = $con->prepare("SELECT * FROM elements WHERE id = $logElement");
                  $sqlEl->execute();
                  $elRow = $sqlEl->fetch();
                  if ($elRow) {
                    $elName = $elRow['name'];
                    $elCustom = $elRow['custom'];
                    $elDescription = $elRow['description'];
                    $elContent = $elRow['content'];
                  }
                }

                // get client info
                $sqlClient = $con->prepare("SELECT * FROM clients WHERE id = $logClient");
                $sqlClient->execute();
                $clientRow = $sqlClient->fetch();
                if ($clientRow) {
                  $logClientName = $clientRow['name'];
                  $logclientAddress = $clientRow['address'];
                  $logClientCreatedAt = $clientRow['createdAt'];
                  $logClientUpdatedAt = $clientRow['updatedAt'];
                }

                $changesDescription = str_replace('%user%', '<span>' . $logUser . '</span>', $changesDescription);
                $changesDescription = str_replace('%time%', '<span>' . $logTime . '</span>', $changesDescription);
                $changesDescription = str_replace('%oldValue%', '<span>' . $logWas . '</span>', $changesDescription);
                $changesDescription = str_replace('%value%', '<span>' . $logIs . '</span>', $changesDescription);
                $changesDescription = str_replace('%client%', '<span>' . $logClientName . '</span>', $changesDescription);

                if ($logElement != null) {
                  $changesDescription = str_replace('%element%', '<span>' . $elName . '</span>', $changesDescription);
                }
                ?>
                  <div class="log__entry" data-log="<?=$logId?>">
                    <span class="date">@<?=$logTime?></span>
                    <?=$changesDescription?>
                  </div>
                <?php
              }
            }
          }
        ?>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/plugins/ScrollToPlugin.min.js"></script>
    <script src="./public/js/components/quicksearch.min.js"></script>
    <script src="./public/js/main.min.js?v=<?=date("YmdGis", filemtime('./public/js/main.min.js'))?>"></script>
  </body>
</html>
