## Page Analyser

[![hexlet-check](https://github.com/just-evv/php-project-lvl3/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/just-evv/php-project-lvl3/actions/workflows/hexlet-check.yml) [![Maintainability](https://api.codeclimate.com/v1/badges/26d8cb2e5ded678702ca/maintainability)](https://codeclimate.com/github/just-evv/php-project-lvl3/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/26d8cb2e5ded678702ca/test_coverage)](https://codeclimate.com/github/just-evv/php-project-lvl3/test_coverage)

### [Online](https://just-evv-analyzer.herokuapp.com/)

__Page Analyser__ - is a service that inspects website's basic seo compliance. 
After validating requested url, the app stores the url in database. After requesting a check, the app retrieves following information from the response and stores it in database:
* Response status code
And, if applied:

* `<h1>` heading
* `<title>`
* the meta name description

####Installation
* clone the repository
* run `make setup`
  or `make docker-setup` for docker-based environment.

####Starting the app
 Start the service using `make start` or `make compose` for docker-based environment.
 You can find the service at [http://localhost:80](http://localhost:80)



