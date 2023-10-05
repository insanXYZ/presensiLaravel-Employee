<?php

function getInitials($name) {
    $words = explode(" ", $name);
    $initials = "";

    $words = array_slice($words, 0, 2);

    foreach ($words as $w) {
        $initials .= $w[0];
    }

    return strtoupper($initials);
}
