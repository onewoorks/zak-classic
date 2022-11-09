<?php

session_start();
?>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<?php

echo "<div id='pageloc'>";

switch ($_GET['a']) {
    case 0;
        include("home/index.php");
        break;
    case 1;
        $_SESSION['pagenow'] = "zak";
        include("zak/index.php");
        break;
    case 2;
        $_SESSION['pagenow'] = "spe";
        include("sistemPengurusanEmas/index.php");
        break;
    case 3;
        include("membership/index.php");
        break;
    case 4;
        include("hargaemas/index.php");
        break;
    case 5;
        break;
    default:
        echo "main menu";
        break;
}
echo "</div>";
?>