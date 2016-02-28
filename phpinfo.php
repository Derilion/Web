<?php
//phpinfo();
 /*
     * Getting current quotes:
     * Reading multible lines of values into an array depending on the given symbols and function tags.
     * Each line holds the values of one symbol. In the argument, symbols are separated by "+".
     *
     * (c) Matthias Brusdeylins, 2008
     * License: CC-GNU GPL (http://creativecommons.org/licenses/GPL/2.0/)
     */    
    define ("QUOTES_URL", "http://finance.yahoo.com/d/quotes.csv?");
    function loadYahooQuotes ($symbol,
                              $tags)
    {
        $lineCount = 0;
        $stocks = array();
        // load the stock quotes: we are opening it for reading
        // http://finance.yahoo.com/d/quotes.csv?s=  STOCK SYMBOLS  &f=  FORMAT TAGS
        $URL = QUOTES_URL."s=$symbol&f=$tags&e=.csv";
        //echo($URL);
        $fileHandle = fopen ($URL,"r");
        if ($fileHandle) {
            // use the fgetcsv function to store quote values into an array $lineValues
            // one symbol in one line
            do {
                $stockValues = fgetcsv ($fileHandle, 999999, ",");
                if ($stockValues) {
                    $lineCount++;
                    $stocks[$lineCount] = $stockValues;
                }
            } while ($stockValues);
        fclose ($fileHandle);
        } else {
            // ERROR-Message in the array
            $stocks[0][0] = "ERROR";
            $stocks[0][1] = "No data found.";
        }
        return $stocks;
    }
$stocks = loadYahooQuotes("AAPL+MSFT","nat1");
print_r($stocks);
?>
