<?php
// Global Variables for editing a student 
$studentId;
$inputName;
$inputSurname;
$inputAge;
$inputCurriculum;
$student;

function editExistingStudent($id)
{
    global $studentId;
    global $student;
    $student = searchIdAndReturnStudent($id);
    if($student)
    {
        $studentId = $student->id;
        editName();
    }
}

function editName()
{
    global $student;
    $name = $student->name;
    echo "Enter name [$name]: ";
    global $inputName;
    $inputName = fgets(STDIN);

    $inputName = cleanInput($inputName);
    if(!strlen($inputName) > 0)
    {
        if(validateTextInput($inputName))
        {
            echo $name."\n";
            editSurname();
            
        }else
        {
            echo "Invalid input, please try again.\n";
            editName();
        }
    }else{
        // echo $name."\n";
        $inputName = $name;
        editSurname();
    }

}

function editSurname()
{
    global $student;
    global $inputSurname;
    $surName = $student->surname;
    echo "Enter Surname [$surName]: ";

    $inputSurname = fgets(STDIN);
    $inputSurname = cleanInput($inputSurname);

    if(!strlen($inputSurname) > 0)
    {
        if(validateTextInput($inputSurname))
        {
            echo $inputSurname."\n";
            editAge();
            
        }else
        {
            echo "Invalid input, please try again.\n";
            editSurname();
        }
    }else{
        // echo $name."\n";
        $inputSurname = $surName;
        editAge();
    }

}

function editAge()
{
    global $student;
    global $inputAge;
    $age;
    $age = $student->age;
    echo "Enter age [$age]: ";

    $inputAge = fgets(STDIN);
    $inputAge = trim($inputAge);
    // echo "Age length: ".strlen($inputAge)."\n";
    if(strlen($inputAge) > 0)
    {
        if(is_numeric($inputAge)) // validate age - will a student be older than 100? 
        {
            if($inputAge < 100)
            {
                echo $inputAge."\n";
                editCurriculum();
            }
            else
            {
                echo "Please enter a valid age\n";
                editAge();
            }
        }else
        {
            echo "Invalid input, please try again.\n";
            editAge();
        }
    }else
    {
        $inputAge = $age;
        echo $inputAge."\n";
        editCurriculum();
    }
}

function editCurriculum()
{
    global $student;
    global $inputCurriculum;
    $curriculum = $student->curriculum;
    echo "Enter Curriculum [$curriculum]: ";

    $inputCurriculum = fgets(STDIN);
    $inputCurriculum = cleanInput($inputCurriculum);

    if(!strlen($inputCurriculum) > 0)
    {
        if(validateTextInput($inputCurriculum))
        {
            echo $inputCurriculum."\n";
            // editAge();
            saveEditedStudentDetails();
            
        }else
        {
            echo "Invalid input, please try again.\n";
            editCurriculum();
        }
    }else{
        // echo $name."\n";
        $inputCurriculum = $curriculum;
        // editAge();
        saveEditedStudentDetails();
    }
}

function saveEditedStudentDetails()
{
    global $studentId;
    global $inputName;
    global $inputSurname;
    global $inputAge;
    global $inputCurriculum;
    $editedStudent = new Student($studentId, $inputName, $inputSurname, $inputAge, $inputCurriculum);
    print_r($editedStudent);
    // saveStudentChangesToFile($editedStudent);
}

function saveStudentChangesToFile($student)
{
    $path = "students/".substr($student->id,0,-5);
    $jsonObj = json_encode($student);

    // if (!file_exists($path)) {
    //     mkdir($path, 0777, true);
    // }
    $filePath = $path."/".$student->id.".json";
    if(is_writable($filePath))
    {
       
        // $handle = fopen("$filePath", "w");
        // fwrite($handle, $jsonObj);
        if (!$handle = fopen($filePath, 'w')) 
        {
            echo "Cannot open file ($student->id)";
            exit;
        }
        // else
        // {

        // }
        if (fwrite($handle, $jsonObj) === FALSE) {
            echo "Cannot write to file ($filePath)";
            exit;
        }
        echo "Student saved successfully.\n";
        fclose($handle);
    }
    else{
        echo "The file $student->id is not writable\n";
    }
}

?>