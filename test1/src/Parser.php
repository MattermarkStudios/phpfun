<?php

namespace Parser;

class Parser
{
    //Task 1: write a method that will check whether a string is properly decoded or not.
    public function checkDecoded(string $input): bool
    {
        //test whether the input is html escaped or not here
        return $bool;
    }

    //Task 2: Write a method that will decode a string.
    // make it sure that it is fully decoded even if it is encoded multiple times.
    public function htmlDecode(string $input): string
    {
        //do the entity decoding operation and output string
        //it can be escaped several times.
        return $output;
    }

    //Task 3: find the key value from an array with uncertain format.
    public function locate(array $array, string $field): string
    {
        return $string;
    }

    //Task 4: write the method to sort the data by create date.
    public static function sortDate(array $a, array $b): int
    {
        //a sorter to put inside the usort. This should return -1, 0, 1
        //assume that the arrays would have keys "creation_date"

        return $sort;
    }

    //Task 5: complete the parser
    public function parse(string $input): array
    {
        $output = [];

        //convert input to json
        $array = json_decode($input, true);

        foreach ($array as $value) {
            //parse the results
            $creationDate = "";
            $text = "";

            $output[] = ["creation_date" => $creationDate, "text" => $text];
        }

        //sort the array
        usort($output, [$this, "sortDate"]);
        return $output;
    }
}
