<?php

// # Custom functions
// For requests which include an URL for e.g. notifications, it is easier to get the URL from the server variables.

function getUrl($path)
{
    $protocol = 'http';

    if ($_SERVER['SERVER_PORT'] === 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on')) {
        $protocol .= 's';
    }

    $host = $_SERVER['HTTP_HOST'];
    $request = $_SERVER['PHP_SELF'];
    return dirname(sprintf('%s://%s%s', $protocol, $host, $request)) . '/' . $path;
}


function getTransactionLink($maid, $transactionId)
{
    $output = sprintf(
        'Transaction ID: <a href="https://api-test.wirecard.com/engine/rest/merchants/%s/payments/%s">',
        $maid,
        $transactionId
    );
    $output .= $transactionId;
    $output .= '</a>';
    return $output;
}
