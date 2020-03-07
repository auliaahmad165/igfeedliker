<?php
set_time_limit(0);
include 'Instagram.class.php';
clear();
echo "
 *  INSTAGRAM FEED LIKER
 *  AUTHOR @auliaahmad16
  
    •••••••••••••••••••••••••••••••••••••••••
    
 * Use tools at your own risk.
 * Use this Tool for personal use, not for sale.
 * I am not responsible for your account using this tool.
 * Make sure your account has been verified (Email & Telp).
 
";
$username    = getUsername();
$password    = getPassword();

echo '•••••••••••••••••••••••••••••••••••••••••' . PHP_EOL . PHP_EOL;
$login = login($username, $password);
if ($login['status'] == 'success') {
    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
    $data_login = array(
        'username' => $login['username'],
        'csrftoken' => $login['csrftoken'],
        'sessionid' => $login['sessionid']
    );

    $slee = getComment('[?]  Sleep in Seconds ( RECOMMENDED 100 ) : ');
  
    while (true) {

        if (n8off() == true):
       $sleep = $slee + rand(0,10);
        $profile    = getHome($data_login);
        $data_array = json_decode($profile);
        $result     = $data_array->user->edge_web_feed_timeline;
        foreach ($result->edges as $items) {
            $id       = $items->node->id;
            $username = $items->node->owner->username;
            $like     = like($id, $data_login);
            if ($like['status'] == 'error') {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Error Like' . PHP_EOL;
                logout($data_login);
                $login = login($username, $password);
                if ($login['status'] == 'success') {
                    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
                    $data_login = array(
                        'username' => $login['username'],
                        'csrftoken' => $login['csrftoken'],
                        'sessionid' => $login['sessionid']
                    );
                }else{

                    die("Something went wrong");

                }
            } else {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Like Success' . PHP_EOL;
            }
            break;
        }
        echo '[+] [' . date("H:i:s") . '] Sleep for ' . $sleep . ' seconds [+]' . PHP_EOL;
        sleep( $sleep);
        echo '•••••••••••••••••••••••••••••••••••••••••' . PHP_EOL . PHP_EOL;
        else:

            echo "Next Run time is 11 AM".PHP_EOL.PHP_EOL;

        sleep(rand(100,600));

        endif;

    }




} else

    echo json_encode($login);
