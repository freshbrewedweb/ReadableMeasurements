<?php

namespace Freshbrewedweb\ReadableMeasurements;

function dd( $var ){
  dump($var);
  die();
}
function dump( $var ) {
  echo '<pre style="border: 2px solid black; background: rgba(0,0,0,0.8); padding: 1em; color:#70f038">';
  var_dump($var);
  echo '</pre>';
}

class ReadableMeasurements {

  protected $original;
  protected $converted;
  protected $matches;

  public function __construct( $string )
  {
    $this->original = $this->sanitize($string);
  }

  /**
   * Private Methods
   */
  private function sanitize($words)
  {
    return implode('', $words);
  }


  /**
   * Public API
   */
  public function get()
  {
    return $this;
  }

}
