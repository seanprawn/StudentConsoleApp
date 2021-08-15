<?php
// include 'Util.php';
// Global Variables for Adding a new student 
$inputId;
$inputName;
$inputSurname;
$inputAge;
$inputCurriculum;

function startAddComp()
{
    //Start with ID and then each function calls the next (If validated)
    addNewId();
}

function addNewId()
{

    echo "Enter id: Would you like to auto generate an id? \n(reply 'y' for yes or 'n' for no )\n";
    $inputAnswer = fgets(STDIN);
    $inputAnswer = trim($inputAnswer);
    if($inputAnswer == "y" || $inputAnswer === "yes")
    {
        autoGenerateId();
    }elseif($inputAnswer ==="n" || $inputAnswer === "no")
    {
        manuallyEnterId();
    }
    else{
        echo "Something went wrong, please manually enter the id\n ";
        manuallyEnterId();
    }
}

function autoGenerateId()
{
    global $inputId;
    $inputId = generateRandomId();
    $inputId = trim($inputId);
    echo "Random id has been generated: ".$inputId."\n";
    if(seacrchForExistingId($inputId))
    {
        // echo "Search for this student: ID=".$searchId." \n";
        // $searchId = trim($searchId);
        // searchForId($inputId);
        echo "Invalid id. $inputId is not unique. Please try again.\n";
        autoGenerateId();
    }else
    {
        addNewName();

    }
}

function manuallyEnterId()
{
    global $inputId; 
    echo "Enter id: ";
    $inputId = fgets(STDIN);
    $inputId = trim($inputId);
    if (is_numeric($inputId))
    {
        if (strlen($inputId) === 7)
        {
            if(seacrchForExistingId($inputId))
            {
                echo "Invalid id. $inputId is not unique. Please try again.\n";
                manuallyEnterId();
            }else
            {
                addNewName();
        
            }
            // addNewName();
        }
        else
        {
            echo "Please enter a 7 digit number!\n";
            manuallyEnterId();
        }
    }
    else
    {
        echo "This not a number. Please enter a number only.\n";
        manuallyEnterId();
    }
}

function addNewName()
{
    echo "Enter name: ";
    global $inputName;
    $inputName = fgets(STDIN);
    $inputName = cleanInput($inputName);

    if(validateTextInput($inputName))
    {
        addNewSurname();
    }else
    {
        echo "Invalid input, please try again.\n";
        addNewName();
    }

}

function addNewSurname()
{
    echo "Enter Surname: ";
    global $inputSurname;
    $inputSurname = fgets(STDIN);
    $inputSurname = cleanInput($inputSurname);

    if(validateTextInput($inputSurname))
    {
        addNewAge();
    }else
    {
        echo "Invalid input, please try again.\n";
        addNewSurname();
    }

}

function addNewAge()
{
    echo "Enter age: ";
    global $inputAge;
    $inputAge = fgets(STDIN);
    $inputAge = trim($inputAge);

    if(is_numeric($inputAge)) // validate age - will a student be older than 100? 
    {
        if($inputAge < 100)
        {
            addNewCurriculum();
        }
        else
        {
            echo "Please enter a valid age\n";
            addNewAge();
        }
    }else
    {
        echo "Invalid input, please try again.\n";
        addNewAge();
    }
}

function addNewCurriculum()
{
    echo "Enter Curriculum: ";
    global $inputCurriculum;
    $inputCurriculum = fgets(STDIN);
    $inputCurriculum = cleanInput($inputCurriculum);

    if(validateTextInput($inputCurriculum))
    {
        saveStudentDetails();
    }else
    {
        echo "Invalid input, please try again.\n";
        addNewCurriculum();
    }
}

function saveStudentDetails()
{
    global $inputId;
    global $inputName;
    global $inputSurname;
    global $inputAge;
    global $inputCurriculum;
    $newStudent = new Student($inputId, $inputName, $inputSurname, $inputAge, $inputCurriculum);
    saveStudentToFile($newStudent);
}

function saveStudentToFile($student)
{
    // get id number for file name
    // create subdir (if not exists)
    // create json data
    // save to json file 
    // alert user of outcome

    $path = "students/".substr($student->id,0,-5);
    $jsonObj = json_encode($student);

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    $bytes = file_put_contents($path."/".$student->id.".json", $jsonObj); 
    echo "Returned: ".$bytes." bytes after writing file\n";
    if($bytes > 0)
    {
        echo "Student saved successfully.\n";
    }
    else
    {
        echo "Unsuccessful, please try again.\n";
    }
}

?>