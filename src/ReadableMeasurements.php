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
  protected $string;
  protected $unit;

  protected $units = [
    'feet' => ['ft', 'foot', "'", '"'],
    'meters' => ['meter', 'm'],
  ];

  public function __construct( $string )
  {
    $this->original = $string;
    $this->string = $this->sanitize( $string );
    $this->setUnit();
  }

  /**
   * Private Methods
   */
  private function sanitize( $string )
  {
    return $string;
  }

  private function setUnit()
  {
    foreach( $this->units as $unit => $syns ) {
      foreach( $syns as $syn ) {
        if( $this->strContains( $syn, $this->string ) ) {
          $this->unit = $unit;
        }
      }
    }

    return $this;
  }

  private function strContains( $needle, $haystack )
  {
    if( strpos($haystack, $needle) !== false )
      return true;
  }

  /**
   * Public API
   */
  public function get()
  {
    return $this->original;
  }

  public function original()
  {
    return $this->original;
  }

}
