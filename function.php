<?php
$value = $_GET['number'];
$count = 1;
$array = array();

function giveMeAChance($number, $count, $array) {
  //Global variables
  //reference array
  $ref            = array(0,1,2,3,4,5,6,7,8,9);
  //variable $num
  $num            = $number;
  $inputs         = (string)($num);
  //Tracked Array
  $scope_input    = $inputs * $count;
  $inputs_array   = str_split($scope_input);

  // base case
  if ($num <= 0 || !(int)$num) {

    print 'Sorry must be a valid number';

  } elseif ($count === 99 || count($array) == 10) {

    return 'Final Number is : '.$number * ($count - 1);
    // break;

  } else {
      //conver number in to string and split it as an array
      // new Array for next call recursion
      if(!empty($array)) {
        $new_array      = $array;
      } else {
        $new_array      = array();
      }

      foreach($inputs_array as $input) {

            // if in the index of the tracked digits
            if(in_array($input, $ref)) {
              //if it's in the old array
                if(in_array($input, $new_array)) {

                  sort($new_array);

                } else {
                  //push value in to the new array
                  array_push($new_array, $input);
                  //sort
                  sort($new_array);

                }
            }
        }
        $new_inputs = (int)$inputs;

        echo 'Number is = '.$scope_input.' , now your have ... ';
          foreach ($new_array as $digits) { print $digits.' '; };
        echo "<br>";

        return giveMeAChance($number, $count + 1, $new_array);
  }

}

print giveMeAChance($value, $count, $array);

 ?>
