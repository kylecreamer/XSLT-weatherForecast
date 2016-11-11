<?php
/**
 * Created by PhpStorm.
 * User: Kyle
 * Date: 11/5/2016
 * Time: 8:17 PM
 * Purpose:  This script will load a forecast XML file which contains a five day weather report for a given area.
 * The output will use weather-related images to visualize the data and display the temperatures, dates, and descriptions
 * to a table.
 */

//Creating a SimpleXML object from the XML file.
$xml=simplexml_load_file("forecast.xml");
//var_dump($xml);
//Xml file creates two types of objects - one is the location which there is one object, and the second type is a daily object
//which contains 5 daily objects.
//Splitting the Object into specific objects, and initializing a high and low for weekly averages.
$location = $xml->location;
$daily = $xml->daily;
$averageHigh = 0;
$averageLow = 0;
?>
<html>
<head>
    <title>Local Forecast</title>
    <style>
        table, tr, td {
            border: 1px solid black;
            vertical-align:top;
        }
        .header{
            font-style: italic;
        }
        body{
            font-family:Verdana, Sans-serif;
        }
        #tableContainer{
            max-width:84.5%;
        }
    </style>
</head>
<body>
<!-- This is a header for our page which will contain the location, the date issued, and the unit of measurement.-->
    <h1>Forecast For <?php echo $location->city . ", " . $location->province . ", " . $location->country; ?></h1>
    <p class="header">Issued at <?php echo $location->issued?></p>
    <h2>Five Day Forecast</h2>
    <p class="header">Degrees in <?php echo $location->degrees?></p>
<div id="tableContainer">
    <table>
        <tr>
            <?php
            //Our table begins with a loop for each day in the daily object.
            foreach($daily->day as $day) {
                //We recursively add to our averages for further calculations.
                $averageHigh += intval($day->high);
                $averageLow += intval($day->low);
                ?>
                <td>
                    <p><?php
                        //We display the date, and in our switch statement we determine the image to use based on the
                        //condition in the XML file for the day.
                        echo $day->date; ?></p>
                    <?php
                            switch($day->condition){
                                case "sun-cloud":
                                    ?><img src="images/sun-cloud.jpg"> </img> <?php
                                     break;
                                case "rain":
                                    ?><img src="images/rain.jpg"> </img> <?php
                                    break;
                                case "overcast":
                                    ?><img src="images/overcast.jpg"> </img> <?php
                                    break;
                                case "snow":
                                    ?><img src="images/snow.jpg"> </img> <?php
                                    break;
                                case "sun":
                                    ?><img src="images/sun.jpg"> </img> <?php
                                    break;
                                case "lightning":
                                    ?><img src="images/lightning.jpg"> </img> <?php
                                    break;
                                case "default":
                                    ?><p>No image available.</p><?php
                                    break;
                            }
                        ?>
                    <p>High:<?php
                        //We output the high and low for each day.
                        echo $day->high; ?> &#176; <br/> Low: <?php echo $day->low; ?>&#176;</p>
                    <hr/>
                    <p><?php
                        //We output the description for each day.
                        echo $day->description; ?></p>
                    </td>
            <?php } ?>
                <td>
                    <!-- Our final calculation and output of the average weekly high and low temperatures.
                        We divide the recursive total by the count of days, and output the value.
                    -->
                    <h2>Daily High: <?php echo ($averageHigh / count($daily->day));?> </h2>
                    <h2>Daily Low: <?php echo ($averageLow / count($daily->day));?> </h2>
                </td>
                </tr>
            </table>
        </div>
    </body>
</html>