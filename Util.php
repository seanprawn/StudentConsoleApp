<?php
/**
 * Utility functions for this app can be found here
 */


$availableOptions = array(
    "add",
    "edit   --id=<id_number> (numbers only!)",
    "delete --id=<id_number> (numbers only!)",
    "search [--action=<action_name>] (*optional)",
);

function validateInputId($inputString)
{
    $result = trim($inputString);
    if(is_numeric($result) && strlen($result) === 7)
    {
        return true;
    }else {
        return false;
    }
}

function validateTextInput($input)
{
    if (!preg_match("/^[a-zA-Z-' ]*$/",$input) && strlen($input) > 20)
    {
       return false;
    }
    else return true;
}

function testInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}

function generateRandomId()
{
    // $seven_digit_random_number = random_int(1000000, 9999999);
    $seven_digit_random_number = mt_rand(1000000, 9999999);
    return $seven_digit_random_number;
}

//Runs the help manual
function runHelp()
{
    global $availableOptions;
    echo "\n----------------------------------------------------------------------------------------\n";
    // echo "----------------------------------------------------------------------------------------\n";
    echo "HELP: \n";
    echo "-------\n";
    echo "Available actions - add, edit, delete, search\n\n";
    echo "-------------------------------------------------\n";
    echo "Please run the program with a first and second argument as below:\n";
    echo "|Main arg|      |2nd arg|\n";
    // echo "-----------------------------------------------------\n";
    foreach($availableOptions as $option)
    {
        echo "--action=".$option."\n";
        echo "-----------------------------------------------------\n";
    }
    echo "----------------------------------------------------------------------------------------\n\n";
}

?>