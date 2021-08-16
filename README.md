# StudentConsoleApp
A small console application, written in native php only. It stores Student data to json files in folders. 

Input:
    -A user starts the program with runStudent.php in the console
    -args (actions) are compulsory
    -A help page lists the available actions (Type '--help' as the arg) * Bonus points

Adding a student:
    -All fields are compulsory
    -id number is unique (it will search and compare before allowing an id to be saved)
    -Program allows a user to auto-generate a random id (or user can still type in manually) * Bonus points
    -Feedback is provided to user on save success or failure

Searching:
    -php is_dir is used for folders, Binary search for data
    -SearchForId is performed when a user inputs a new id number (used in validation)
    -SearchForId is also used when editing or deleting a student (id canot be changed)
    -SearchForItem is used to search a specific term (Searhes through all folders and files)


