<?php

function getGenres(DOMNodeList $genres)
{
    $total = '';
    foreach ($genres as $genre) {
        $current = $genre->nodeValue;
        $total = $genre->nextElementSibling ? "${total}${current}, " : "${total}${current}";
    }
    return $total;
}
