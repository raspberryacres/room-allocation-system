<?php

include("config/config.php");

$hostels = [

    'Male Hostel 1',
    'Male Hostel 2',
    'Female Hostel 1',
    'Female Hostel 2'

];

$bedspaces = [

    'L1',
    'L2',
    'R1',
    'R2'

];

foreach ($hostels as $hostel) {

    for ($floor = 1; $floor <= 3; $floor++) {

        for ($room = 1; $room <= 26; $room++) {

            $roomNo = ($floor * 100) + $room;

            foreach ($bedspaces as $bed) {

                $query = "INSERT INTO rooms

(hostelName,roomNo,bedSpace)

VALUES

('$hostel',
'$roomNo',
'$bed')";

                mysqli_query($conn, $query);

            }

        }

    }

}

echo "Rooms generated successfully";

?>