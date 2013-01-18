CI-Code-Generator [![Build Status](https://travis-ci.org/willmendesneto/CI-Code-Generator.png?branch=master)](https://travis-ci.org/willmendesneto/CI-Code-Generator)
=================

A code generator console for Codeigniter Framework. Based in other code generators
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

    php ci-code-generator generator:view [names-of-views]

### Generator:model

Generate a view file with the specified name in 'application/models' directory

    php ci-code-generator generator:model [name-of-model] [methods]

### Generator:model

Generate a view file with the specified name in 'application/controllers' directory

    php ci-code-generator generator:model [name-of-model] [methods]

### Generator:controller

Generate a controller file with the specified name in `application/controllers` directory

    php ci-code-generator generator:controller [name-of-controller] [methods]

### * New features soon




