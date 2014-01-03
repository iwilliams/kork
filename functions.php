<?php

function logError($error) {
    $logFileName = 'logs/error.log';
    if (is_writable($logFileName)) {
        // In our example we're opening $filename in append mode.
        // The file pointer is at the bottom of the file hence
        // that's where $somecontent will go when we fwrite() it.
        if (!$handle = fopen($logFileName, 'a')) {
            echo "Cannot open file ($logFileName)";
            exit ;
        }

        // Write $somecontent to our opened file.
        if (fwrite($handle, $error) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit ;
        }

        echo "Success, wrote ($error) to file ($logFileName)";

        fclose($handle);
    } else {
        file_put_contents($logFileName, $error);
    }

}
