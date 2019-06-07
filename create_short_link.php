<?php
require __DIR__.'/config.php';
require __DIR__.'/Handler.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $link = $_POST['link'];
    try {
        $obj = new Handler();
        $shortLink = $obj->addNewLinkInOurDB($link);
        if ($shortLink) {
            echo '<h1>Congratulation!</h1>
            <p>Here is your short link: </p>
            <p><a href="'.$shortLink.'">'.$shortLink.'</a></p>
            <p>Thanks for using our service</p>';
        } else {
            echo ERROR_MSG_CREATE;
        }
    } catch (Exception $e) {
        echo ERROR_MSG_CREATE;
    }
}
?>
<form method="post">
    <label>Please, enter your link address
        <input type="text" name="link" placeholder="http://mysite.com">
        <input type="submit">
    </label>
</form>