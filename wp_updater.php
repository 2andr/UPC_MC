<?PHP
include_once('updater.php');

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'UPC_MC-master', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/2andr/UPC_MC', // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/2andr/UPC_MC/beta', // the github raw url of your github repo
        'github_url' => 'https://github.com/2andr/UPC_MC', // the github url of your github repo
        'zip_url' => 'https://github.com/2andr/UPC_MC/zipball/beta', // the zip url of the github repo
        'sslverify' => true, // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and  https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        'readme' => 'README.MD' // which file to use as the readme for the version number
    );
    new WP_GitHub_Updater($config);
}

?>