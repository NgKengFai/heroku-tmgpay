<html>
<body>
<?php
    $json=file_get_contents("http://api-v2.tamago.tv//mobile/mobileAreaCodes.html");
    $data =  json_decode($json);

    if (count($data->code_maps)) {
        // Open the table
        echo "<table>";

        // Cycle through the array
        foreach ($data->code_maps as $idx => $code_maps) {

            // Output a row
            echo "<tr>";
            echo "<td>$code_maps->country</td>";
            echo "<td>$code_maps	->area</td>";
            echo "</tr>";
        }

        // Close the table
        echo "</table>";
    }
?>
</body>
</html>
