<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" rel="stylesheet" crossorigin="anonymous">
  <meta charset="utf-8">
  <title></title>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <a class="navbar-brand" href="login.php">Contacts Log</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </nav>



  <div class="d-flex justify-content-center align-items-center" style="height:600px;">

    <div class="card border-primary mb-3" style="max-width: 100rem;">
      <div class="card-header">Login</div>
      <div class="card-body text-primary">

        <form action="login.php" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Username</label>
              <input type="username" class="form-control" id="username" placeholder="Username" name="username">
            </div>
            <div class="form-group col-md-6">
              <label>Password</label>
              <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
          </div>


          <button type="submit" class="btn btn-primary">Login</button>
        </form>

      </div>
    </div>
  </div>
</div>

<?php

require '../private/vendor/autoload.php';
require '../private/constants.php';

if($_SERVER['REQUEST_METHOD']==='POST'){

  $username = $_POST['username'];
  $password = $_POST['password'];

  $client = new GuzzleHttp\Client();
  $res = $client->request('POST', WWW_ROOT . '/private/login.php', [
    'http_errors' => false,

    'headers' => [
      'token' => 'FEBB222BFE78A'
    ],

    'json'    => [
      'username' => $username,
      'password' => $password
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
