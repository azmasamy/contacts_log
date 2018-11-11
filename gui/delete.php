

  <?php
  require '../private/initialize.php';


  if($_SERVER['REQUEST_METHOD']==='GET'){

    if(isset($_GET['id'])) {

      $contact_id = $_GET['id'];

      $client = new GuzzleHttp\Client();
      $res = $client->request('VIEW', WWW_ROOT . '/private/api.php', [
        'http_errors' => false,

        'headers' => [
          'token' => 'FEBB222BFE78A'
        ],

        'json' => [
          'id' => $contact_id
        ]

      ]);

      $body = json_decode($res->getBody(), true);
      $message = $body['status']['message'];
      $contact_data = $body['data'];


    }
  }

  ?>


  <div class="d-flex justify-content-center align-items-center" style="height:600px;">

    <div class="card border-primary mb-3" style="max-width: 200rem;">
      <div class="card-header">Delete Contact?</div>
      <div class="card-body text-primary">

        <form id="delete_form" method="POST" action="delete.php">
          <input type="hidden" class="form-control" id="id" name="id" value="<?php if( isset($contact_data['id'])) echo $contact_data['id']; ?>">
        </form>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Phone Numbers</th>
              <th scope="col">Phone Titles</th>
              <th scope="col">Default Numbers</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"> <?php if( isset($contact_data['id'])) echo $contact_data['id']; ?> </th>
              <td> <?php if(isset($contact_data['first_name'])) echo $contact_data['first_name']; ?> </td>
              <td> <?php if(isset($contact_data['last_name'])) echo $contact_data['last_name']; ?> </td>
              <td> <?php if(isset($contact_data['contact_info']['0']['phone_title'])) echo $contact_data['contact_info']['0']['phone_title'];    if( isset($contact_data['contact_info']['1']['phone_title'])) echo ", " . $contact_data['contact_info']['1']['phone_title']; ?></td>
              <td> <?php if(isset($contact_data['contact_info']['0']['phone_number'])) echo $contact_data['contact_info']['0']['phone_number'];  if( isset($contact_data['contact_info']['1']['phone_number'])) echo ", " . $contact_data['contact_info']['1']['phone_number']; ?></td>
              <td> <?php if(isset($contact_data['contact_info']['0']['default_num'])) echo $contact_data['contact_info']['0']['default_num'];    if( isset($contact_data['contact_info']['1']['default_num'])) echo ", " . $contact_data['contact_info']['1']['default_num']; ?></td>
              <td> <button type="submit" class="btn btn-danger" form="delete_form">Delete</button> </td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>


<div class="d-flex justify-content-center align-items-center">
  <?php
  if($_SERVER['REQUEST_METHOD']==='GET'){
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

<?php


if($_SERVER['REQUEST_METHOD']==='POST'){


  $contact_id = $_POST['id'];

  $client = new GuzzleHttp\Client();
  $res = $client->request('DELETE', WWW_ROOT . '/private/api.php', [
    'http_errors' => false,

    'headers' => [
      'token' => 'FEBB222BFE78A'
    ],

    'json' => [
      'id' => $contact_id
    ]
  ]);

  $body = json_decode($res->getBody(), true);
  $message = $body['status']['message'];


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


</body>
</html>
