<?php

function CallAPI($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-API-KEY: x',
        'Content-Type: application/json',
    ));

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
?>

<html>
    <body>
        <?php

        $data_array = array(
            "daemonHost" => "127.0.0.1",
            "daemonPort" => 17291,
            "filename" => "mywallet.wallet",
            "password" => "supersecretpassword"
        );
        $response = CallAPI('POST', '127.0.0.1:17280/wallet/create', json_encode($data_array));
        var_dump($response);
        ?>
    </body>
</html>
