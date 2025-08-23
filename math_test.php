<?php
/*
    Practice Assignment 2
    Task: Create a PHP file named math_test.php
    with a script that performs and displays the results of various mathematical operations.
*/
$num1 = 30;
$num2 = 12;
$rate = 0.05;

//Calculate and display
$sum = $num1 + $num2;
$product = $num1 * $num2;
$quotient = $num1 / $num2;
$remainder = $num1 % $num2;
$percentIncrease = $num1 * (1 + $rate);

// Display the results
echo "Sum: $sum\n";
echo "Product: $product\n";
echo "Quotient: $quotient\n";
echo "Remainder: $remainder\n";
echo "Percent Increase: $percentIncrease\n";

if ($num1 > $num2) {
    echo "$num1 is greater than $num2\n";
} elseif ($num1 < $num2) {
    echo "$num1 is less than $num2\n";
} else {
    echo "$num1 is equal to $num2\n";
}

if ($num1 > 100 || $num2 > 100) {
    echo "At least one number is 100 or greater.\n";
} else {
    echo "Neither number is 100 or greater.\n";
}
?>