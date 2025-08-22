<?php
/*
 Practice Assignment 1
 Task: Create a simple PHP file names my_first_script.php
 with a script that displays:
 Author: [Your Name]
 Department: [Your Department]
 Date: Using the current date function
 Description: This script demonstrates basic PHP syntax and output.
*/

$Author = "Godswill Chimnonso";
$Department = "Computer Science";
$Date = date("Y-m-d");
$Description = "This script demonstrates basic PHP syntax and output.";

// Display the information
echo "Author: $Author\n";
echo "Department: $Department\n";
echo "Date: $Date\n";
echo "Description: $Description\n";
?>