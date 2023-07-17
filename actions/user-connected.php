<?php session_start() ?>
<pre>
<?= var_dump($_SESSION)?>
</pre>

<?php

$_COOKIE['stayLoggedIn'];
$_SESSION['idUserConnected'];