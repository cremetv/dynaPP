<?php
  include_once('top.php');

  if (isset($_GET['id']) && $_GET['id'] != '' && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    echo 'No ID provided';
    return;
  }
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client | Impressum & Datenschutz API</title>
    <style>
      .active {
        color: #2ecc71;
      }
    </style>
  </head>
  <body>

    <?php
      $sql = "SELECT * FROM clients WHERE id = $id";
      $result = $con->query($sql);

      if ($result->rowCount() > 0) {
        ?>
          <table>
            <thead>
              <tr>
                <th>id</th>
                <th>name</th>
                <th>address</th>
                <th>createdAt</th>
                <th>updatedAt</th>
              </tr>
            </thead>
            <tbody>
        <?php

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $id = $row['id'];
          $name = $row['name'];
          $address = $row['address'];
          $createdAt = $row['createdAt'];
          $updatedAt = $row['updatedAt'];
          ?>
            <tr>
              <td><?=$id?></td>
              <td><?=$name?></td>
              <td><?=$address?></td>
              <td><?=$createdAt?></td>
              <td><?=$updatedAt?></td>
            </tr>
          <?php
        }

        ?>
            </tbody>
          </table>
        <?php
      } else {
        echo 'no entry found';
      }
    ?>





    <?php
      $clientChecks = [];
      $clientChecksCustom = [];
      $sql = "SELECT * FROM checklist WHERE clientId = $id";
      $result = $con->query($sql);

      if ($result->rowCount() > 0) {
        ?>
          <ul>
            <hr>
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $checkId = $row['id'];
          $elementId = $row['elementId'];
          $custom = $row['custom'];
          $position = $row['position'];

          ?>
            <li><?=$id?> | element: <?=$elementId?> | custom: <?=$custom?> | position: <?=$position?></li>
          <?php

          if ($custom == '1') {
            $elTable = 'customs';
            array_push($clientChecksCustom, $elementId);
          } else {
            $elTable = 'elements';
            array_push($clientChecks, $elementId);
          }

          $sqlEl = "SELECT * FROM $elTable WHERE id = $elementId";
          $resultEl = $con->query($sqlEl);

          if ($resultEl->rowCount() > 0) {
            while ($row = $resultEl->fetch(PDO::FETCH_ASSOC)) {
              $elementName = $row['name'];
              $elementDescription = $row['description'];
              $elementContent = $row['content'];
              ?>
                <li><?=$elementName?> | <?=$elementDescription?></li>
                <hr>
              <?php
            }
          } else {
            echo '<li>No element ' . $elementId . ' found</li>';
          }

        }
        ?>
          </ul>
        <?php
      } else {
        echo 'no checklist entrys found';
      }
    ?>








    client checks:<br>
    <?php print_r($clientChecks); ?><br>

    client checks custom:<br>
    <?php print_r($clientChecksCustom); ?><br>








    <h3>Elements:</h3>
    <?php
    $sql = "SELECT * FROM elements";
    $result = $con->query($sql);

    if ($result->rowCount() > 0) {
      ?>
        <ul>
      <?php
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $elId = $row['id'];
        $elName = $row['name'];
        $elDescription = $row['description'];
        $elContent = $row['content'];

        if (in_array($elId, $clientChecks)) {
          $checked = 'active';
        } else {
          $checked = '';
        }

    	  ?>
          <li class="<?=$checked?>"><?=$elName?></li>
        <?php

      }
      ?>
        </ul>
      <?php
    } else {
      echo 'no elements entrys found';
    }
    ?>




    <h3>Custom Fields:</h3>
    <?php
    $sql = "SELECT * FROM customs";
    $result = $con->query($sql);

    if ($result->rowCount() > 0) {
      ?>
        <ul>
      <?php
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $elId = $row['id'];
        $elName = $row['name'];
        $elDescription = $row['description'];
        $elContent = $row['content'];

        if (in_array($elId, $clientChecksCustom)) {
          $checked = 'active';
        } else {
          $checked = '';
        }

    	  ?>
          <li class="<?=$checked?>"><?=$elName?></li>
        <?php

      }
      ?>
        </ul>
      <?php
    } else {
      echo 'no custom elements entrys found';
    }
    ?>



  </body>
</html>
