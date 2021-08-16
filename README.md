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
    -SearchForId is performed when a user inputs a new id number (used in validation)
    -SearchForStudent and rturns a student -is also used when editing or deleting a student (id canot be changed)
    -SearchAllStudents is used to search a specific student or returns all students(Searches through all folders and files) and prints to the user.

Edit:
    -Edit an existing student
    -Displays current values on the screen and allows the user to keep it or change it

Delete:
    -Deletes a user based on the id provided
    -Also deletes the folder the file was in (if it is empty) * Bonus points

Student class
    -Student object is parsed into json format and saved into the files in folders starting with first 2 digits of id

View
    -All print outs in human readable format
    -Methods for reusable code to print out searches in Table format


