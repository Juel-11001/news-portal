<?php

/** formate tags */


function formateTags(array $tags)
{
    $data=implode(',', $tags);
    return $data;
}