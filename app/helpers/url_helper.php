<?php
// Page Redirect
function redirect($page) {
    header('location: ' . URL_ROOT . '/' . $page);
}