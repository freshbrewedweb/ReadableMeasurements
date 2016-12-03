<?php

require __DIR__ . '/../vendor/autoload.php';

use Freshbrewedweb\ReadableMeasurements\ReadableMeasurements;

$string = $_GET['string'] ?? NULL;
$unit = $_GET['toUnit'] ?? NULL;

try {
  $measurement = new ReadableMeasurements( $string );
} catch( Exception $e ) {
  $error = $e->getMessage();
}

/**
 * @filename: currentgitbranch.php
 * @usage: Include this file after the '<body>' tag in your project
 * @author Kevin Ridgway
 */
// $repoName = "ReadableMeasurements";
// $repo = json_decode(file_get_contents("https://api.github.com/repos/freshbrewedweb/$repoName"));
//
// $git = "<div style='clear: both; width: 100%; font-size: 14px; font-family: Helvetica; color: #30121d; background: #bcbf77; padding: 20px; text-align: center;'>Origin: <span style='color:#fff; font-weight: bold; text-transform: uppercase;'>" . $repo->html_url . "</span></div>"; //show it on the page

?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      select {
        -webkit-appearance: none;
        background:
          no-repeat
          95% center
          url(data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MCA1MCIgaGVpZ2h0PSI1MHB4IiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgNTAgNTAiIHdpZHRoPSI1MHB4IiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48cmVjdCBmaWxsPSJub25lIiBoZWlnaHQ9IjUwIiB3aWR0aD0iNTAiLz48cG9seWdvbiBwb2ludHM9IjQ3LjI1LDE1IDQ1LjE2NCwxMi45MTQgMjUsMzMuMDc4IDQuODM2LDEyLjkxNCAyLjc1LDE1IDI1LDM3LjI1ICIvPjwvc3ZnPg==);
        background-size: auto 50%;
      }
      input, select {
        padding: 0.5em 1em;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 0;
        background-color: white;
      }
      button {
        background: black;
        color: white;
        border: none;
      }
      pre {
        background-color: #f2f2f2;
        color: #333;
        text-align: left;
        padding: 2em;
        margin: 1em 0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.5);
      }
    </style>
  </head>
  <body>
    <form style="width:90%; max-width:600px;margin:3em auto;">
      <div style="display:flex;">
        <input type="text" name="string" value="<?= $measurement->original() ?>" style="flex: 1 0 auto">
        <select name="toUnit">
          <option value="m">Meters</option>
          <option value="cm">Centimeters</option>
          <option value="ft">Feet</option>
        </select>
        <button type="submit" style="flex: 1 0 auto">Convert</button>
      </div>

      <?php if( isset($error) ): ?>
        <pre><?php print_r( $error ) ?></pre>
      <?php else: ?>
        <pre><?php
            foreach( $measurement->convertTo($unit)->values() as $value ) {
              echo $value . $unit . "\n";
            }
        ?></pre>
        <!-- <?php var_dump( $measurement ) ?> -->
      <?php endif; ?>
    </pre>
    </form>
  </body>
</html>
