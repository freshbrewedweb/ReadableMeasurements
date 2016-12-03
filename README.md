# ReadableMeasurements
PHP utility to extract measurements from human readable form.

## Usage

```php
$string = "10-20 feet";
$measurement = new ReadableMeasurements( $string );

echo $measurement->get();
```

**Results** in `['value' => [10, 20], 'unit' => 'feet']`

## API
- `get` gets the resulting matches.
