<?php
  include_once('top.php');
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log | Impressum & Datenschutz API</title>
  </head>
  <body>



    <?php
      $sql = "SELECT * FROM log";
      $result = $con->query($sql);

      if ($result->rowCount() > 0) {

        ?>
          <table>
            <tr>
              <th>user</th>
              <th>time</th>
              <th>client</th>
              <th>changes</th>
              <th>element</th>
              <th>was</th>
              <th>is</th>
            </tr>
        <?php

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $logId = $row['id'];
          $logUser = $row['user'];
          $logTime = $row['time'];
          $logClient = $row['client'];
          $logChanges = $row['changes'];
          $logElement = $row['element'];
          $logWas = $row['was'];
          $logIs = $row['isNow'];

          // get changes description
          $sqlChanges = "SELECT * FROM changes WHERE name = '$logChanges'";
          $resultChanges = $con->query($sqlChanges);
          if ($resultChanges->rowCount() > 0) {
            while ($row = $resultChanges->fetch(PDO::FETCH_ASSOC)) {
              $changesDescription = $row['description'];
            }
          }

          // get element info
          if ($logElement != null) {
            $sqlEl = "SELECT * FROM elements WHERE id = $logElement";
            $resultEl = $con->query($sqlEl);
            if ($resultEl->rowCount() > 0) {
              while ($row = $resultEl->fetch(PDO::FETCH_ASSOC)) {
                $elName = $row['name'];
                $elCustom = $row['custom'];
                $elDescription = $row['description'];
                $elContent = $row['content'];
              }
            }
          }

          // get client info
          $sqlClient = "SELECT * FROM clients WHERE id = $logClient";
          $resultClient = $con->query($sqlClient);
          if ($resultClient->rowCount() > 0) {
            while ($row = $resultClient->fetch(PDO::FETCH_ASSOC)) {
              $clientName = $row['name'];
              $clientAddress = $row['address'];
              $clientCreatedAt = $row['createdAt'];
              $clientUpdatedAt = $row['updatedAt'];
            }
          } else {
            echo 'NO CLIENT';
          }

          $changesDescription = str_replace('%user%', $logUser, $changesDescription);
          $changesDescription = str_replace('%time%', $logTime, $changesDescription);
          $changesDescription = str_replace('%value%', $logIs, $changesDescription);
          $changesDescription = str_replace('%client%', $clientName, $changesDescription);

          if ($logElement != null) {
            $changesDescription = str_replace('%element%', $elName, $changesDescription);
          }

          ?>
            <tr>
              <td><?=$logUser?></td>
              <td><?=$logTime?></td>
              <td><?=$clientName?></td>
              <td><?=$changesDescription?></td>
              <td><?php if ($logElement != null) { echo $elName; } else { echo '-'; } ?></td>
              <td><?=$logWas?></td>
              <td><?=$logIs?></td>
            </tr>
          <?php
        }

        ?>
          </table>
        <?php

      } else {
        echo 'no log entries found';
      }
    ?>



  </body>
</html>
