<?php include_once('top.php'); ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Impressum & Datenschutz API</title>

  </head>
  <body>


    <?php
    $sql = "SELECT * FROM clients";
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
            <td><a href="client.php?id=<?=$id?>"><?=$id?></a></td>
            <td><a href="client.php?id=<?=$id?>"><?=$name?></a></td>
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
      echo 'no entrys found';
    }
    ?>


  </body>
</html>

<?php $con = null; ?>
