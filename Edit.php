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
        editName($studentId);
    }
}

function editName($id)
{
    global $student;
    $detailsSaved = array();
    $detailsSaved["id"] = $id;
    $name = $student->name;
        echo "Enter name [$name]: ";
        global $inputName;
        $inputName = fgets(STDIN);
        $inputName = trim($inputName);
        // $inputName = cleanInput($inputName);
        if(strlen($inputName) > 0)
        {
            if(validateEditTextInput($inputName))
            {
                $detailsSaved["name"] = $inputName;
                editSurname($detailsSaved);
                
            }else
            {
                echo "Invalid input, please try again.\n";
                editName($id);
            }
        }else
        {
            $detailsSaved["name"] = $name;
            editSurname($detailsSaved);
        }
}

function editSurname($detailsSaved)
{
    global $student;
    global $inputSurname;
    $surName = $student->surname;
    echo "Enter Surname [$surName]: ";

    $inputSurname = fgets(STDIN);
    $inputSurname = trim($inputSurname);

    if(strlen($inputSurname) > 0)
    {
        if(validateEditTextInput($inputSurname))
        {
            $detailsSaved["surName"] = $inputSurname;
            editAge($detailsSaved);
            
        }else
        {
            echo "Invalid input, please try again.\n";
            editSurname($detailsSaved);
        }
    }else{
        $detailsSaved["surName"] = $surName;
        editAge($detailsSaved);
    }

}

function editAge($detailsSaved)
{
    global $student;
    global $inputAge;
    $age;
    $age = $student->age;
    echo "Enter age [$age]: ";

    $inputAge = fgets(STDIN);
    $inputAge = trim($inputAge);
    if(strlen($inputAge) > 0)
    {
        if(is_numeric($inputAge)) // validate age - will a student be older than 100? 
        {
            if($inputAge < 100)
            {
                $detailsSaved["age"] = $inputAge;
                editCurriculum($detailsSaved);
            }
            else
            {
                echo "Please enter a valid age\n";
                editAge($detailsSaved);
            }
        }else
        {
            echo "Invalid input, please try again.\n";
            editAge($detailsSaved);
        }
    }else
    {
        $detailsSaved["age"] = $age;
        editCurriculum($detailsSaved);
    }
}

function editCurriculum($detailsSaved)
{
    global $student;
    global $inputCurriculum;
    $curriculum = $student->curriculum;
    echo "Enter Curriculum [$curriculum]: ";

    $inputCurriculum = fgets(STDIN);
    $inputCurriculum = trim($inputCurriculum);
    // $inputCurriculum = cleanInput($inputCurriculum);

    if(strlen($inputCurriculum) > 0)
    {
        if(validateEditTextInput($inputCurriculum))
        {
            $detailsSaved["curriculum"] = $inputCurriculum;
            saveEditedStudentDetails($detailsSaved);
            
        }else
        {
            echo "Invalid input, please try again.\n";
            editCurriculum($detailsSaved);
        }
    }else{
        $detailsSaved["curriculum"] = $curriculum;
        saveEditedStudentDetails($detailsSaved);
    }
}

function saveEditedStudentDetails($detailsSaved)
{
    print_r($detailsSaved);
    $editedStudent = new Student($detailsSaved['id'], $detailsSaved['name'], $detailsSaved['surName'], $detailsSaved['age'], $detailsSaved['curriculum']);
    // print_r($editedStudent);
    saveStudentChangesToFile($editedStudent);
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