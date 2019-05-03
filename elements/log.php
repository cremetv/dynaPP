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
