<?php

require __DIR__ . '/../vendor/autoload.php';

use Freshbrewedweb\ReadableMeasurements\ReadableMeasurements;

$string = $_GET['string'] ?? NULL;

try {
  $measurement = new ReadableMeasurements( $string );
} catch( Exception $e ) {
  $error = $e->getMessage();
}
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
      }
    </style>
  </head>
  <body>
    <form style="width:90%; max-width:600px;margin:3em auto;">
      <div style="display:flex;">
        <input type="text" name="string" value="<?= $measurement->original() ?>" style="flex: 1 0 auto">
        <button type="submit" style="flex: 1 0 auto">Convert</button>
      </div>
      <pre>
      <?php if( isset($error) ): ?>
        <?php print_r( $error ) ?>
      <?php else: ?>
        <?php print_r( $measurement->get() ) ?>
      <?php endif; ?>
    </pre>
    </form>
  </body>
</html>
