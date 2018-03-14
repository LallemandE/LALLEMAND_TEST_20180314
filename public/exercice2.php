<?php
function convert ($amount, $curr){
    // test of received values for the parameters
    if ((is_int($amount) || is_float($amount)) && (($curr == "EUR") || ($curr == "USD"))){
        
        // return is only expected if the second parameter is USD
        if ($curr == 'USD'){
            $result = $amount . ' euro = ' . ($amount * 1.085965) . ' US dollars';
            return $result;
        }
    }
}

// end of the exercice. Next part has been used to test the function

echo "ZAR<br>";
echo convert(100, "ZAR"). "<BR>";
echo "EUR<br>";
echo convert(100, "EUR"). "<BR>";
echo "wrong amount<BR>";
echo convert ("tutu", "USD"). "<BR>";
echo "Next ones should work properly<BR>";
echo convert (100, "USD"). "<BR>";
echo convert (1, "USD"). "<BR>";

