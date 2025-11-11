<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Install Controller
 * Redirects to setup.php for database installation
 */
class Install extends CI_Controller {

    public function index() {
        // Redirect to setup.php for database installation
        $base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
                    "://" . $_SERVER['HTTP_HOST'] .
                    rtrim(dirname($_SERVER['PHP_SELF']), '/');

        header("Location: " . $base_url . "/setup.php");
        exit;
    }
}
