<div class="container-fluid">
  <div class="row p-1">
    <div class="col justify-content-center"><?php
if (isset($anzst)) {
    for ($i = 1; $i <= $anzst; $i++) {
        if ($lmtype == 1) {
            if ($i == $anzst) {
                $j = $text[364];
                $k = $text[365];
            } else if ($i == $anzst - 1) {
                $j = $text[362];
                $k = $text[363];
            } else if ($i == $anzst - 2) {
                $j = $text[360];
                $k = $text[361];
            } else if ($i == $anzst - 3) {
                $j = $text[358];
                $k = $text[359];
            } else {
                $j = $i;
                $k = $text[366];
            }
        } else {
            $j = sprintf('%02d', $i);
            $k = $text[9];
        }

        if ($i != $st || empty($tabdat)) {
            if (isset($todo) && $todo == 'tabs') {
                echo "<a class='btn btn-sm' href='" . $addb . $i . "' data-bs-toggle='tooltip' data-bs-placement='top' title='" . $k . "'>" . $j . "</a>";
            } else {
                if ($i == $st) {
                    echo "<a class='btn btn-sm btn-info' href='" . $addr . $i . "' data-bs-toggle='tooltip' data-bs-placement='top' title='" . $k . "'>" . $j . "</a>";
                } else {
                    echo "<a class='btn btn-sm' href='" . $addr . $i . "' data-bs-toggle='tooltip' data-bs-placement='top' title='" . $k . "'>" . $j . "</a>";
                }
            }
        } else {
            echo "<a class='btn btn-sm btn-info' href='" . $addr . $i . "' data-bs-toggle='tooltip' data-bs-placement='top' title='" . $k . "'>" . $j . "</a>";
        }
        echo "\n";
        $break = "</div>\n</div>\n<div class='row p-2'>\n<div class='col justify-content-center'>\n";
        if (($anzst > 47) && (($anzst % 4) == 0)) {
            if (($i == $anzst / 4) || ($i == $anzst / 2) || ($i == $anzst / 4 * 3)) {
                echo $break;
            }
        } elseif (($anzst > 35)) {
            if (($i == ceil($anzst / 3)) || ($i == ceil($anzst / 3 * 2))) {
                echo $break;
            }
        } elseif (($anzst > 23)) {
            if ($i == ceil($anzst / 2)) {
                echo $break;
            }
        }
    }
}
?>
    </div>
  </div>
</div>