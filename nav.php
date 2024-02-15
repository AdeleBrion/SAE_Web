<link rel="stylesheet" href="css/nav.css">
<link rel="icon" href="fixtures/images/logoBarre.png" type="image/png">
<script src="js/menu.js"></script>

<?php

require_once "Classes/Navigation.php";
$nav = new Navigation();
echo $nav;

?>
