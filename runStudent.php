<?php
include 'Student.php';
include 'Add.php';
include 'Edit.php';
include 'Delete.php';
include 'Search.php';


$availableOptions = array(
    "add",
    "edit",
    "delete",
    "search",
);

$shortOpts  = "";
$longOpts  = array(
    "action::",    // Optional action value
    "id::",        // optional Value for student ID
     "help",        // optional Value for help
);

$options = getOpt($shortOpts,$longOpts);
//   $myArgs = var_dump($options);
if(isset($options["action"]))
{
    if($options["action"] == "add")
    {
        echo "Ok Lets add a student! \n";
        addNewStudent();
    }
    else if($options["action"] == "edit")
    {
        echo "Ok Lets edit this student! \n";
        editExistingStudent();
    }
    else if($options["action"] == "delete")
    {
        echo "Delete this student \n";
        deleteExistingStudent();
    }
    else if($options["action"] == "search")
    {
        echo "Search for this student \n";
        searchStudent();
    }else
    {
        echo "Incorrect argument, please try again.\nor use --help to see available actions.\n";
    }
}
else if(isset($options["help"]))
{
    echo "\n\n----------------------------------------------------------------------------------------\n";
    echo "Help: Available actions\n";
    echo "----------------------------------------------------------------------------------------\n";
    echo "Please run the program with one of the following arguments:\n";
    foreach($availableOptions as $option)
    {
        echo "--action=".$option."\n";
    }
}
else
{
    echo "Incorrect argument, please try again. \nor use --help to see available actions.\n";
}

function addNewStudent()
{
    // Runs the Add component. 
    // Each function in the add component calls the next function (only if validated)
    startAddComp();

}

function generateRandomId()
{
    $seven_digit_random_number = random_int(1000000, 9999999);
    return $seven_digit_random_number;
}

function searchStudent()
{

}

// $id = generateRandomId();
// $s2 = new Student($id, "John", "Smith", 46, "Food");
// $s2->getInfo();
// echo "Are you sure you want to do this?  Type 'yes' to continue: ";
// $input = fgets(STDIN); //trim whitespace to avoid errors
// // $handle = fopen ("php://stdin","r");
// // $line = fgets($handle);
// if(trim($input) != 'yes'){
//     echo "ABORTING!\n";
//     exit;
// }
// fclose($handle);
// fclose($input);

// echo "\n";
// echo "Thank you, continuing...\n";


/*TODO
- Prompt user for input - Done!
- Validate inputs - Done!
- Validate unique id?
- Format inputs as human readable - done!
- Get actions from args  - 
- Validate input args - Done!
- Unique ids - 
- perform actions:
-   Save student to json file in folder structure with subdir starting with first two digits - done!
-   edit student based on id as arg
-   delete student based on id as arg
-   Search for student
*/
?>