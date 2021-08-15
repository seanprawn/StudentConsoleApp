<?php
// get an array of all the folders with a match to first 2 digits
    // binary search algorithm for items:
    // 
    $studentFolders;

    /**
     * Searches for an id
     * 
     */
    function searchForId($id)
    {
        $searchFolder = substr($id,0,-5);
        $dirs = getDirectories();
        if($dirs)
        {
            foreach($dirs as $folder)
            {
                if($folder === $searchFolder)
                {
                    // echo "Yay found a folder: ".$searchFolder."\n";
                    $myStudent = file("students/".$searchFolder."/".$id.".json");
                    if($myStudent)
                    {
                        $student = json_decode($myStudent[0],false);
                        // print_r($student);
                        printStudentDetails($student);
                    }
                }
            }
        }
        else{
            echo "No Student found";
        }
    }

    function getDirectories()
    {
        $dir = 'students';
        $exclude = array( ".",".."); // Clean up the array by deleting element not needed
        global $studentFolders;
        $studentFolders = array();
        if(is_dir($dir))
        {
            $folders = scandir($dir);
            foreach($folders as $folder)
            {
                if(!in_array($folder, $exclude))
                {
                    array_push($studentFolders, $folder);
                }
            }
            return $studentFolders;
        }
        else
        {
            echo "No parent directory found for 'students'\n";
        }
        // print_r($studentFolders);
    }

    function printStudentDetails($student)
    {
        $idLbl = "|id";
        $nameLbl = "|Name";
        $sNameLbl = "|Surname";
        $ageLbl = "|Age";
        $curriclmLbl = "|Curriculum";
        $spaces = 20;
        $offset =1;
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

    function createSpaces($spaces)
    {
        for($i=$spaces;$i>0;$i--)
        {
            echo " ";
        }
    }
?>

