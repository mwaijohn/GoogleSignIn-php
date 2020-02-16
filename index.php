<?php 
require_once 'config.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .sign-in, .logout{
            padding:15px;
            color:white;
            font-weight:900;
            text-transform: uppercase;
            background-color:#304ffe;
            border: 0 ;
            border-radius:3px;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>

<?php if(isset($_GET['code'])){
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $_SESSION['access_token'] = $token['access_token'];
    //check for errors if not
    if(!isset($token['error'])){
        //set access token
        $google_client->setAccessToken($token['access_token']);
        //get the data
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        $name = $data['given_name'];
        $family_name = $data['family_name'];
        $gender = $data['gender'];
        $email = $data['email'];
        $picture_url = $data['picture'];


        echo '<div class="data">
                    <div class="email">Email: '.$email .'</div>
                    <div class="name">Name: '.$name. " ". $family_name .'</div>
                    <div class="gender">Gender: '.$gender.'</div>
              </div><br><br>';
    }else{
        //get values from session
    }
}?>
<?php if(isset($_SESSION['access_token'])){

    echo '<a href="logout.php" class="logout">Log out</a>';

}else{
    echo '<a href="'.$auth_url.'" ><button class="sign-in">Sign in with google</button></a>';

}?>


</body>
</html>

