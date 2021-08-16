<?php 

class Student {

    public $id;
    public $name = "";
    public $surname = "";
    public $age = 0;
    public $curriculum = "";

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

      // Methods
  public function set_id($id) {
   $this->name = $name;
  }
  public function get_id() {
    return $this->id;
  }

  public function set_name($name) {
    $this->name = $name;
  }
  public function get_name() {
    return $this->name;
  }

  public function set_surname($surname) {
    $this->surname = $surname;
  }
  public function get_surname() {
    return $this->surname;
  }

  public function set_age($age) {
    $this->age = $age;
  }
  public function get_age() {
    return $this->age;
  }

  public function set_curriculum($curriculum) {
    $this->curriculum = $curriculum;
  }
  public function get_curriculum() {
    return $this->curriculum;
  }



  public function getInfo()
    {
        echo "Student----------> \nName: $this->name $this->surname \nid: $this->id \nAge: $this->age years \nStudying: $this->curriculum\n";
    }

}

?>