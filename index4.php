<?php

// Class
class greeting
{

  // Static Variable/Property
  public static $name = "Faraz";

  // Static Method/Function
  public static function message()
  {
    echo "Welcome, have a nice day!";
  }
}

// Method Calling
greeting::message();

echo "<br>";

// Variable Echo
echo greeting::$name;