<?php
    $url = $_SERVER["REQUEST_URI"];
    $parts = explode("/",$url);
    $activePart = $parts[count($parts)-1];
?>
<nav>
    <a href=<?="/".SITE_NAME."/"?> class=<?php if($activePart == ""){echo "active";} ?>>Polling units</a>
    <a href=<?="/".SITE_NAME."/getTotal"?> class=<?php if($activePart == "getTotal"){echo "active";} ?>>Total  result</a>
    <a href=<?="/".SITE_NAME."/addScore"?> class=<?php if($activePart == "addScore"){echo "active";} ?>>Add scores</a>
</nav>