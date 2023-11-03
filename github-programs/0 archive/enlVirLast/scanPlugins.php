<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("ls.php");

$pluginsPath = "../wp_cp/wp-content/plugins";

$plugins = ls_one($pluginsPath);

foreach ($plugins as $p) {
	echo $p . "</br>";
}

/*
$plugins = get_plugins(); 
foreach ($plugins as $plugin_file => $plugin_data) {
    echo '<p><strong>' . htmlspecialchars($plugin_data['Name']) . '</strong></p>';
    echo '<p>' . htmlspecialchars($plugin_data['Description']) . '</p>';
    echo '<p>Link do repozytorium WordPress: <a href="https://pl.wordpress.org/plugins/' . htmlspecialchars($plugin_data['Slug']) . '/">https://pl.wordpress.org/plugins/' . htmlspecialchars($plugin_data['Slug']) . '/</a></p>';
    echo '<p>Link do producenta: [wpb_external_links link="http://' . htmlspecialchars($plugin_data['AuthorURI']) . '" class="dotted"]' . htmlspecialchars($plugin_data['Author']) . '[/wpb_external_links]</p>';
}*/

?>