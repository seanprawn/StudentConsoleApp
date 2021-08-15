<?php 

class Student {

    public $id;
    public $name = "";
    public $surname = "";
    public $age = 0;
    public $curriculum = 0;

    function __construct($id, $name, $surname, $age, $curriculum) {
        // echo "Student object is created \n";
        // echo "Student Name is $name $surname\n";
        $this->id = $id;
        // echo "ID is $this->id\n";
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->curriculum = $curriculum;

    }

     function getInfo()
    {
        echo "Student----------> \nName: $this->name $this->surname \nid: $this->id \nAge: $this->age years \nStudying: $this->curriculum\n";
    }

}

?>