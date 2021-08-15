<?php

/**
 * This file contains all my methods and algorithms for searching
 * -Search for a specific ID and print out results
 * - Search for existing Student using unique id
 * -Search that returns all students saved
 */
    $studentFolders;
    $spaces;
    /**
     * Searches for a student with given id
     * Prints out the student if found
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
                    if(file_exists("students/".$searchFolder."/".$id.".json"))
                    {
                        $myStudent = file("students/".$searchFolder."/".$id.".json");
                        if($myStudent)
                        {
                            $student = json_decode($myStudent[0],false);
                            // print_r($student);
                            printLables();
                            printStudentDetails($student);
                        }
                    }
                    else
                    {
                        echo "No Student found\n";
                    }
                }
            }
        }
        else{
            echo "No Student found\n";
        }
    }

    /**
     * Returns an array of all directories found in the student folder
     */
    function getDirectories()
    {
        $dir = 'students';
        $exclude = array( ".",".."); // Clean up the array by deleting elements not needed.
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
    }

    /**
     * Searches for an Id and returns true if found, or false if not found
     */
    function seacrchForExistingId($id)
    {
        $searchFolder = substr($id,0,-5);
        $dirs = getDirectories();
        if($dirs)
        {
            foreach($dirs as $folder)
            {
                if($folder === $searchFolder)
                {
                    if(file_exists("students/".$searchFolder."/".$id.".json"))
                    {
                        return true;
                    }
                    else return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    function searchAllStudents()
    {
        $dirs = getDirectories();
        $allStudents = array();
        $exclude = array( ".",".."); // Clean up the array by deleting elements not needed.
        // $searchFolder = substr($id,0,-5);
        printLables();
        if($dirs)
        {
            foreach($dirs as $folder) //each folder
            {
                // echo "\nFolder: ".$folder."\n";
                $fileArray = scandir("students/".$folder); // each collection of files in its folder

                if(!in_array($fileArray, $exclude))
                {
                    for($i=0;$i<count($fileArray);$i++)
                    { 
                        if(!preg_match("/^[.]*[0-9]*$/",$fileArray[$i])) //this regex searches for 1 or 2 dots followed by numbers
                        { 
                            // echo "i = ".$fileArray[$i]."\n";
                            $currentPath = "students/".$folder."/".$fileArray[$i];
                            // echo "currentPath:\n".$currentPath."\n";
                            if(file_exists($currentPath))
                            {
                                $myStudent = file($currentPath);
                                // echo"My Student: ".$myStudent;
                                if($myStudent)
                                {
                                    // print_r($myStudent);
                                    $parsedStudent = json_decode($myStudent[0],false);
                                    // echo "\nParsed Student:\n";
                                    // print_r($parsedStudent);
                                    array_push($allStudents, $parsedStudent);
                                    // foreach($allStudents as $student)
                                    for($i=0;$i<count($allStudents);$i++)
                                    {
                                        printStudentDetails($allStudents[$i]);
                                    }
                                }
                            }
                        }
                        // $files = scandir("students/".$dir);
                        // if(!in_array($file, $exclude))
                        // echo "File:\n".$file."\n";
                        // // print_r($file);
                    }
                }
            }
            // echo "\nAll students: \n";
            // print_r($allStudents);
        }
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

