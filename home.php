 <?php
    include('config.php');
    include('class/userClass.php');
    $userClass = new userClass();
    $userDetails = $userClass->userDetails($_SESSION['uid']);

    if ($_POST['code']) {
        $code = $_POST['code'];
        $secret = $userDetails->google_auth_code;
        require_once 'googleLib/GoogleAuthenticator.php';
        $ga = new GoogleAuthenticator();
        $checkResult = $ga->verifyCode($secret, $code, 2);

        if ($checkResult) {
            $_SESSION['googleCode'] = $code;
        } else {
            echo 'FAILED';
        }
    }

    include('session.php');
    $userDetails = $userClass->userDetails($session_uid);

    ?>
 <!DOCTYPE html>
 <html>

 <head>
     <title>Sistema de Login com 2FA / Google</title>
     <link rel="stylesheet" type="text/css" href="style.css" charset="utf-8" />
 </head>

 <body>
     <div id="container">
         <h1>Bem-vindo <?php echo $userDetails->name; ?></h1>

         <pre>
<?php print_r($userDetails); ?>

</pre>
         <h4><a href="<?php echo BASE_URL; ?>logout.php">Logout</a></h4>
     </div>
 </body>

 </html>