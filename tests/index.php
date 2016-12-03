<?php

require __DIR__ . '/../vendor/autoload.php';

use Freshbrewedweb\ReadableMeasurements\ReadableMeasurements;

$string = $_GET['string'] ?? NULL;

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
$repoName = "ReadableMeasurements";
$repo = json_decode(file_get_contents("https://api.github.com/repos/freshbrewedweb/$repoName"));

$git = "<div style='clear: both; width: 100%; font-size: 14px; font-family: Helvetica; color: #30121d; background: #bcbf77; padding: 20px; text-align: center;'>Origin: <span style='color:#fff; font-weight: bold; text-transform: uppercase;'>" . $repo->html_url . "</span></div>"; //show it on the page

?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      input {
        padding: 0.5em 1em;
        box-sizing: border-box;
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
        padding: 1em;
        margin: 1em;
        box-shadow: 0 1px 2px rgba(0,0,0,0.5);
      }
    </style>
  </head>
  <body>
    <div><?= $git ?></div>
    <form style="width:90%; max-width:600px;margin:3em auto;">
      <div style="display:flex;">
        <input type="text" name="string" value="<?= $measurement->original() ?>" style="flex: 1 0 auto">
        <button type="submit" style="flex: 1 0 auto">Convert</button>
      </div>

      <?php if( isset($error) ): ?>
        <pre><?php print_r( $error ) ?></pre>
      <?php else: ?>
        <pre><?php print_r( $measurement->get() ) ?></pre>
        <pre><?php var_dump( $measurement ) ?></pre>
      <?php endif; ?>
    </pre>
    </form>
  </body>
</html>
