CI-Code-Generator [![Build Status](https://travis-ci.org/willmendesneto/CI-Code-Generator.png?branch=master)](https://travis-ci.org/willmendesneto/CI-Code-Generator)
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


### * New features soon




