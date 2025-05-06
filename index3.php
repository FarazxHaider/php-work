<?php 

class Fruit{

  // Properties
  public  $name;
  public $color;


  // Methods/Functions
  public function __construct($name,$color){
    $this->name = $name;
    $this->color = $color;
  }

  function intro(){
    echo "The fruit is {$this->name} and the color is {$this->color}.";
  }

  function set_name($name){
    $this->name = $name;
  }

  function get_name(){
    return $this->name;
  }

  function set_color($color){
    $this->color = $color;
  }

  function get_color(){
    return $this->color;
  }

}

class Strawberry extends Fruit{

  function message(){
   echo "Am I a fruit or a berry? "; 
  }

}


// Object Creation
  // $apple = new Fruit();
  // $mango = new Fruit();

  $Strawberry = new Strawberry('Strawberry','red');



  // Set Values
  // $apple->set_name('Apple');
  // $apple->set_color('Red');

  // $mango->set_name('Mango');
  // $mango->set_color('Yellow');


// Print
 
  /*
  echo  "Apple Object";
  echo "<br>";
  echo "----------------";
  echo "<br>";
  echo $apple->get_name();
  echo "<br>";
  echo $apple->get_color();

  echo "<br>";
  echo  "Mango Object";
  echo "<br>";
  echo "----------------";
  echo "<br>";
  echo $mango->get_name();
  echo "<br>";
  echo $mango->get_color();
  */


  echo $Strawberry->intro();
  echo "<br>";
  echo $Strawberry->message();






?>