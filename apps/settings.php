<?php

function hostinfo() {
    return "http://" . $_SERVER['HTTP_HOST'] . '/';
}
