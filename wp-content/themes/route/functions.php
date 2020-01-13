<?php
/**
 *
 * Codestar Framework
 *
 * @author Codestar
 * @license Commercial License
 * @link http://codestar.me
 * @copyright 2014 Codestar Themes
 * @package CSFramework
 * @version 1.0.0
 *
 */
locate_template( 'cs-framework/init.php', true );
function my_login_logo_one() { 
?> 
<style type="text/css"> 
body.login div#login h1 a {
 background-image: url(https://bihar-portal-beta.egovernments.org/wp-content/uploads/2019/10/bihar-sarkar-logo-1.png);  //Add your own logo image in this url 
padding-bottom: 30px; 
} 
</style>
 <?php 
} add_action( 'login_enqueue_scripts', 'my_login_logo_one' );
