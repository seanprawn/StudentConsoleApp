<?php
// include 'Student.php';
/**
 * This file contains all my methods and algorithms for searching
 * -Search for a specific ID and print out results
 * - Search for existing Student using unique id
 * -Search that returns all students saved
 * -Search that returns a specific student
 * 
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
                else
                    {
                        echo "No Student folder found\n";
                    }
            }
        }
        else{
            echo "No Student directories found\n";
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
                          if(rmdir("students/".$searchFolder."/"))
                          {
                            //Removed if empty folder?
                          }
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
        $dirs = getDirectories();
        $allStudents = array();
        $fileArray = array();
        $path = "students/";
        echo "All Students:\n";
        printLables();

        if($dirs)
        {
            foreach($dirs as $dir) //each folder containing json files
            {
            $fileArray = scandir("students/".$dir); // each collection of files in its folder
                       
                if(is_dir($path.$dir))
                {
                    if ($dh = opendir($path.$dir))
                    {
                        while (($file = readdir($dh)) !== false) 
                        {
                            if(!preg_match("/^[.]*[0-9]*$/",$file)) //this regex excludes 1 or 2 dots, but not dots followed by numbers
                            {
                                $currentPath = $path.$dir."/".$file;
                                if(file_exists($currentPath))
                                {
                                    $myStudent = file($currentPath);
                                    if($myStudent)
                                    {
                                        $parsedStudent = json_decode($myStudent[0],false); //parse each student to an object
                                        array_push($allStudents, $parsedStudent); //gets each student and adds it into array
                                    }
                                }
                            }
                        }
                        closedir($dh);
                    }
                }
            }

            for($i=0;$i<count($allStudents);$i++)
            {
                printStudentDetails($allStudents[$i]);
            }
        }
    }


?>

