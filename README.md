CI-Tools [![Build Status](https://travis-ci.org/willmendesneto/CI-Tools.png?branch=master)](https://travis-ci.org/willmendesneto/CI-Code-Generator)
=================

A code generator console for Codeigniter Framework. Based in other code generators
* ZFTools (Zend Framework)
* Artisan (Laravel Framework)
* Bake (CakePHP)

## How to use

1 Put in your project. You can:
* Download this files;
* Clone this repo;

2 Enable PHP command line in your project

After this, open de cmd and navigate to your project folder:

Windows

    cd path/of/your/project/

Linux

    ls path/of/your/project/


## Methods

### Generator:view

Generate a view file with the specified name in `application/views` directory

    php ci-tools generator:view [name]

### Generator:model

Generate a model file with the specified name in 'application/models' directory

    php ci-tools generator:model [name] [methods]

OR

    php ci-tools generator:model [name] [extends:class] [methods]

### Generator:controller

Generate a controller file with the specified name in `application/controllers` directory

    php ci-tools generator:controller [name] [methods]

OR

	php ci-tools generator:controller [name] [extends:class] [methods]

### Generator:assets

Generate a view file with the specified name in `assets/` directory

    php ci-tools generator:assets [name]

List of the external assets files:

Javascript
* jquery.js (http://code.jquery.com/jquery.min.js)
* backbone.js (http://backbonejs.org/backbone.js)
* underscore.js (http://underscorejs.org/underscore.js)
* handlebars.js (http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.rc.1.js)
* jasmine-jquery.js (https://raw.github.com/velesin/jasmine-jquery/master/lib/jasmine-jquery.js)
* live.js (http://livejs.com/live.js)

CSS
* normalize.css (https://raw.github.com/necolas/normalize.css/master/normalize.css)
* reset.css (http://meyerweb.com/eric/tools/css/reset/reset200802.css')

### Generator:key

Generate a encryption_key for the application in `application/config/config.php` file

    php ci-tools generator:key

### * New features soon




