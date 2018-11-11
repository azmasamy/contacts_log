
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

    <div class="card border-primary mb-3" style="max-width: 100rem;">
      <div class="card-header">Edit Contact</div>
      <div class="card-body text-primary">

        <form action="edit.php" method="POST">
          <div class="form-row">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php if( isset($contact_data['id'])) echo $contact_data['id']; ?>">
            <div class="form-group col-md-6">
              <label>First Name</label>
              <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="<?php if( isset($contact_data['first_name'])) echo $contact_data['first_name']; ?>">
            </div>
            <div class="form-group col-md-6">
              <label>Last Name</label>
              <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="<?php if( isset($contact_data['last_name'])) echo $contact_data['last_name']; ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Phone Title 1</label>
              <input type="text" class="form-control" id="phone_title1" placeholder="Mobile" name="phone_title1" value="<?php if( isset($contact_data['contact_info']['0']['phone_title'])) echo $contact_data['contact_info']['0']['phone_title']; ?>">
            </div>
            <div class="form-group col-md-4">
              <label>Phone Number 1</label>
              <input type="number" class="form-control" id="phone_number1" placeholder="05xxxxxxxxx" name="phone_number1" value="<?php if( isset($contact_data['contact_info']['0']['phone_number'])) echo $contact_data['contact_info']['0']['phone_number']; ?>">
            </div>
            <div class="form-group col-md-2">
              <label>Default 1</label>
              <input type="number" class="form-control" id="default1" placeholder="9" name="default1" value="<?php if( isset($contact_data['contact_info']['0']['default_num'])) echo $contact_data['contact_info']['0']['default_num']; ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Phone Title 2</label>
              <input type="text" class="form-control" id="phone_title2" placeholder="Home" name="phone_title2" value="<?php if( isset($contact_data['contact_info']['1']['phone_title'])) echo $contact_data['contact_info']['1']['phone_title']; ?>">
            </div>
            <div class="form-group col-md-4">
              <label>Phone Number 2</label>
              <input type="number" class="form-control" id="phone_number2" placeholder="05xxxxxxxxx" name="phone_number2" value="<?php if( isset($contact_data['contact_info']['1']['phone_number'])) echo $contact_data['contact_info']['1']['phone_number']; ?>">
            </div>
            <div class="form-group col-md-2">
              <label>Default 2</label>
              <input type="number" class="form-control" id="default2" placeholder="9" name="default2" value="<?php if( isset($contact_data['contact_info']['1']['default_num'])) echo $contact_data['contact_info']['1']['default_num']; ?>">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Save</button>
        </form>

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
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  $phone_title1 = $_POST['phone_title1'];
  $phone_number1 = $_POST['phone_number1'];
  $default1 = $_POST['default1'];

  $phone_title2 = $_POST['phone_title2'];
  $phone_number2 = $_POST['phone_number2'];
  $default2 = $_POST['default2'];

  $client = new GuzzleHttp\Client();
  $res = $client->request('PUT', WWW_ROOT . '/private/api.php', [
    'http_errors' => false,

    'headers' => [
      'token' => 'FEBB222BFE78A'
    ],

    'json' => [
      'id' => $contact_id,
      'first_name' => $first_name,
      "last_name" => $last_name,
      "numbers" => [ $phone_number1, $phone_number2 ],
      "phone_title" => [ $phone_title1, $phone_title2 ],
      "default_numbers" => [ $default1, $default2]
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
