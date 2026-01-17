<?php
if (!isset($_SESSION['admin'])) {
    die("Access denied");
}