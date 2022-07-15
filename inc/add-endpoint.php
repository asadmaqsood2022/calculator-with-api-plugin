<?php
get_header();

use Djunehor\Number\WordToNumber;

$wordToNumber = new WordToNumber();
$wordTransformer = $wordToNumber->getWordTransformer();
// you can specify locale via: $wordToNumber->getWordTransformer('en');

$api_url = 'https://100insure.com/mi/api1.php';

// Read JSON file
$json_data = file_get_contents($api_url);
// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$key1 = $response_data->key1;

$key2 =$response_data->key2;

$number1 = $wordTransformer->toNumber($key1 );
$number2 = $wordTransformer->toNumber($key2 );

function calculator_results($number1,$number2,$operation) {
    // API URL
    $url = 'https://100insure.com/mi/api2.php';

    // Create a new cURL resource
    $ch = curl_init($url);

    // Setup request to send json via POST
    $data = array(
        'num1' => $number1,
        'num2' => $number2,
        "operation"=>$operation
    );
    $payload = json_encode($data);
    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Execute the POST request
    $result = curl_exec($ch);
    echo $result;
    // Close cURL resource
    curl_close($ch);
}
?>
<table style="width: 50%;text-align: center;margin: auto;">
  <tr>
    <th>Num1</th>
    <th>Operation</th>
    <th>Num2</th>
    <th>Result</th>
  </tr>
  <tr>
    <td><?php echo $number1; ?></td>
    <td><strong>+</strong></td>
    <td><?php echo $number2; ?></td>
    <td><?php calculator_results($number1,$number2,'plus'); ?></td>
  </tr>
  <tr>
    <td><?php echo $number1; ?></td>
    <td><strong>-</strong></td>
    <td><?php echo $number2; ?></td>
    <td><?php calculator_results($number1,$number2,'minus'); ?></td>
  </tr>
  <tr>
    <td><?php echo $number1; ?></td>
    <td><strong>x</strong></td>
    <td><?php echo $number2; ?></td>
    <td><?php calculator_results($number1,$number2,'times'); ?></td>
  </tr>
  <tr>
    <td><?php echo $number1; ?></td>
    <td><strong>÷</strong></td>
    <td><?php echo $number2; ?></td>
    <td><?php calculator_results($number1,$number2,'divided by'); ?></td>
  </tr>

</table>

<?php

get_footer();
