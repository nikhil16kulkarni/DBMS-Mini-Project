<?php

function random_strings()
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $length = 14;
    $bid = substr(str_shuffle($str_result) , 0, $length);
    return $bid;
}
function generate_bid()
{
    $bid = random_strings();
    x:
        if (mysqli_num_rows(mysqli_query('select bookingid from appointment where bookingid = ' . $bid)))
        {
            $bid = random_strings();
            gotox;
        }
        else
        {
            return $bid;
        }
    }

?>