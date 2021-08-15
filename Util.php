<?php
/**
 * ---------------------------------------------------------
 * Utility functions for this app can be found in this file
 * ---------------------------------------------------------
 */

/**
 * Components in this app
 * (Options that are available at to the user)
 */

$spaces;

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
    if (!preg_match("/^[a-zA-Z-' ]*$/",$input))
    {
       return false;
    }
    else if(strlen($input) > 20) return false;
    else 
    return true;
}

function cleanInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}

function generateRandomId()
{
    // $seven_digit_random_number = random_int(1000000, 9999999); // random_int does not work with older versions of php
    $seven_digit_random_number = mt_rand(1000000, 9999999);
    return $seven_digit_random_number;
}

/**
 * Displays help to the user
*/
function runHelp()
{
    global $availableOptions;
    echo "\n----------------------------------------------------------------------------------------\n";
    echo "HELP: \n";
    echo "-------\n";
    echo "Available actions - add, edit, delete, search\n\n";
    echo "-------------------------------------------------\n";
    echo "Please run the program with Main and Second arguments as below:\n";
    echo "|Main arg|      |2nd arg|\n";

    foreach($availableOptions as $option)
    {
        echo "--action=".$option."\n";
        echo "-----------------------------------------------------\n";
    }
    echo "----------------------------------------------------------------------------------------\n\n";
}

function printStudentDetails($student)
{
    $offset =1;
    global $spaces;
    $spaces = 20;
        echo "|".$student->id;
        createSpaces($spaces -strlen($student->id)-$offset);
        echo "|".$student->name;
        createSpaces($spaces - strlen($student->name)- $offset);
        echo "|".$student->surname;
        createSpaces($spaces - strlen($student->surname)-$offset);
        echo "|".$student->age;
        createSpaces($spaces - strlen($student->age)-$offset);
        echo "|".$student->curriculum;
        echo "\n----------------------------------------------------------------------------------------------------------------\n";
}

function printLables()
{
    $idLbl = "|id";
    $nameLbl = "|Name";
    $sNameLbl = "|Surname";
    $ageLbl = "|Age";
    $curriclmLbl = "|Curriculum";
    global $spaces;
    $spaces = 20;
    echo "----------------------------------------------------------------------------------------------------------------\n";
    echo $idLbl;
    createSpaces($spaces-strlen($idLbl));
    echo $nameLbl;
    createSpaces($spaces-strlen($nameLbl));
    echo $sNameLbl;
    createSpaces($spaces-strlen($sNameLbl));
    echo $ageLbl;
    createSpaces($spaces-strlen($ageLbl));
    echo $curriclmLbl;
    echo "\n----------------------------------------------------------------------------------------------------------------\n";
}
function createSpaces($spaces)
{
    for($i=$spaces;$i>0;$i--)
    {
        echo " ";
    }
}

?>