<?php
include 'Student.php';
include 'Add.php';
include 'Edit.php';
include 'Delete.php';
include 'Search.php';
include 'Util.php';

/**
 * This app is modularised. 
 * This component acts as a controller and makes calls to the other components as neccessary(Depending on user input).
 */

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
        startAddComp();
    }
    else if($options["action"] == "edit" && isset($options["id"]))
    {

        $searchId = $options["id"];
        if(validateInputId($searchId))
        {
            echo "Ok Lets edit this student: ID=".$searchId."\n";
            $searchId = trim($searchId);
            // searchForId($searchId);
            editExistingStudent($searchId);
        }else
        {
            echo "Invalid id. $searchId is incorrect. Please try again.\n";
        }
    }
    else if($options["action"] == "delete" && isset($options["id"]))
    {

        $searchId = $options["id"];
        if(validateInputId($searchId))
        {
            echo "Delete this student: ID=".$searchId."\n";
            $searchId = trim($searchId);

            $delete = searchIdAndDeleteStudent($searchId);
            if($delete)
            {
                echo "File Deleted successfully";
            }

        }else
        {
            echo "Invalid id. $searchId is incorrect. Please try again.\n";
        }

    }
    else if($options["action"] == "search" && isset($options["id"]))
    {
        $searchId = $options["id"];
        if(validateInputId($searchId))
        {
            echo "Search for this student: ID=".$searchId." \n";
            $searchId = trim($searchId);
            searchForId($searchId);
        }else
        {
            echo "Invalid id. $searchId is incorrect. Please try again.\n";
        }
    }
    else if($options["action"] == "search")
    {
        searchAllStudents();
    }
    else
    {
        echo "Incorrect argument, please try again.\nor use --help to see available actions.\n";
    }
}
else if(isset($options["help"]))
{
    runHelp();
}
else
{
    echo "Incorrect argument, please try again. \nor use --help to see available actions.\n";
}

/*TODO
- Prompt user for input - Done!
- Validate inputs - Done!
- Validate unique id? - Done!
- Format inputs as human readable - done!
- Get actions from args  - Done!
- Validate input args - Done!
- Unique ids - Done!
- perform actions:
-   Save student to json file in folder structure with subdir starting with first two digits - done!
-   edit student based on id as arg - Done!
-   delete student based on id as arg - Done!
-   Search for student - Done!
-   Search for all students if arg is left blank - Done!

----BUGS:
---Edit student saving blank records
---Search all produces duplicates
---Delete folders? (non essential but annoying)
---
*/
?>