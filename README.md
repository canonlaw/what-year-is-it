# WhatYear.is/it

WhatYear.is/it is an easy, simple website that displays the current litrugical year according to the Roman Rite of the Catholic Church.

## Development

### Production
- index.php is the entry point which provides the display for the site.
- app.php provides the PHP logic.
- There are no build steps.

### Unit Testing
- run `composer test` to run the unit tests.
- `tests/bootstrap.php` provides the testing bootstrap that loads before any unit test run.
- `tests/test_app.php` provides test coverage for the liturgical year logic.
