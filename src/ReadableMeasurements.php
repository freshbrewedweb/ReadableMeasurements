<?php

namespace Freshbrewedweb\ReadableMeasurements;

use PhpUnitsOfMeasure\PhysicalQuantity\Length;

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
  protected $values = [];
  protected $convertedValues = [];

  protected $units = [
    'feet' => ["feet", 'ft', 'foot'],
    'meters' => ['meter', 'm'],
    'inches' => ['inches', 'in'],
  ];

  public function __construct( $string )
  {
    $this->original = $string;
    $this->string = $this->sanitize( $string );
    $this->setUnit();
    $this->setValues();
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

  private function extractNumbers()
  {
    preg_match_all('/[0-9]*\.?[0-9]+/', $this->string, $matches);
    return $matches[0];
  }

  private function setValues()
  {
      $this->values = array_merge($this->values, $this->extractNumbers());
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

  public function convertTo( $unit )
  {
    $this->convertedValues = array_map(function($value) use ($unit){
      $measurement = new Length($value, $this->unit);
      return $measurement->toUnit($unit);
    }, $this->values);

    return $this;
  }

  public function values() {
    if( !empty($this->convertedValues) )
      return $this->convertedValues;
    else
      $this->values;
  }

}
