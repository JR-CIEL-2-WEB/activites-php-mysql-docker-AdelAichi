<?php
function triangle($n) {
    for ($i = 1; $i <= $n; $i++) {
        echo str_repeat(" ", $n - $i);
        echo str_repeat("*", 2 * $i - 1);
        echo "\n";
    }
}
?>
