<?php

/**
 * This file contains all my methods and algorithms for searching
 * -Search for a specific ID and print out results
 * - Search for existing Student using unique id
 * -Search that returns all students saved
 */
    // $studentFolders;

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
        // global $studentFolders;
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

    function searchIdAndReturnStudent($id)
    {
        $searchFolder = substr($id,0,-5);
        $dirs = getDirectories();
        if($dirs)
        {
            foreach($dirs as $folder)
            {
                if($folder === $searchFolder)
                {
                    $path = "students/".$searchFolder."/".$id.".json";
                    if(file_exists($path))
                    {
                        $file = file($path);
                        
                        if($file)
                        {
                            $student = json_decode($file[0],false);
                            return $student;
                        }
                        else 
                        {
                            echo "Error - Student record not found\n";
                        }
                    }
                    else 
                    {
                        echo "Error - Student record not found\n";
                    }
                }
            }
        }
        else
        {
            echo "Error - Student record not found\n";
        }
    }

    function searchIdAndDeleteStudent($id)
    {
        $searchFolder = substr($id,0,-5);
        $dirs = getDirectories();
        if($dirs)
        {
            foreach($dirs as $folder)
            {
                if($folder === $searchFolder)
                {
                    $path = "students/".$searchFolder."/".$id.".json";
                    // if(file_exists($path))
                    // {
                        // $file = file($path);
                        
                        if (is_file($path))
                        {
                          unlink($path);
                          return true;
                        }
                        else 
                        {
                            echo "Error - Student record not found\n";
                        }
                    // }
                    // else 
                    // {
                    //     echo "Error - Student record not found\n";
                    // }
                }
            }
        }
        else
        {
            echo "Error - Student record not found\n";
        }
    }

    function searchAllStudents()
    {
        // $dirs = null;
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


?>

