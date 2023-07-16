<?php

function xssFilter($args) {
    if (is_array($args)) {
        array_walk_recursive($args, function (&$value) {
            $value = htmlspecialchars($value);
        });
        return $args;
    }
    return htmlspecialchars($args);
}
