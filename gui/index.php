
  <?php

  require '../private/initialize.php';

  if($_SERVER['REQUEST_METHOD']==='GET'){

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', WWW_ROOT . '/private/api.php', [
      'http_errors' => false,

      'headers' => [
        'token' => 'FEBB222BFE78A'
      ]

    ]);
    $body = json_decode($res->getBody(), true);
    $message = $body['status']['message'];

    $all_contacts_data = $body['data'];

    ?>

  <div class="d-flex justify-content-center align-items-center">

    <div class="card border-primary mb-3" style="max-width: 200rem;">
      <div class="card-header">Contacts</div>
      <div class="card-body text-primary">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Phone Numbers</th>
              <th scope="col">Phone Titles</th>
              <th scope="col">Default Numbers</th>
              <th scope="col">Options</th>
            </tr>
          </thead>
          <tbody>

            <?php
            foreach ($all_contacts_data as $contact_info) {
              echo "<tr>";
              echo "<th scope=\"row\">" . $contact_info['id'] . "</th>";
              echo "<td>" . $contact_info['first_name'] . "</td>";
              echo "<td>" . $contact_info['last_name'] . "</td>";
              echo "<td>" . implode(", ", $contact_info['numbers']) . "</td>";
              echo "<td>" . implode(", ", $contact_info['phone_title']) . "</td>";
              echo "<td>" . implode(", ", $contact_info['default_numbers']) . "</td>";
              echo "<td> <a href=\"" . WWW_ROOT . "/gui/edit.php?id=" . $contact_info['id'] ."\" style=\"color:#9ACD32;\">Edit</a> <a href=\"" . WWW_ROOT . "/gui/delete.php?id=" . $contact_info['id'] ."\" style=\"color:red;\">Delete</a> </td>";
              echo "</tr>";
            }
             ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-center align-items-center" style="height:100px;">
  <?php
  if($res->getStatusCode() == 200) {
    echo '<div class="d-flex justify-content-center align-items-center">'
    .'<div class="alert alert-success">'
    .$message
    ."</div>";
    echo '</div>';
  } else {
    echo '<div class="d-flex justify-content-center align-items-center">';
    echo '<div class="alert alert-danger">';
    echo $message . "<br>";
    echo '</div>';
    echo '</div>';
  }
}
?>
</div>




</body>
</html>
