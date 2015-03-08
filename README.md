Link0\ProfilerBundle
==============
[![Latest Stable Version](https://poser.pugx.org/link0/profiler-bundle/v/stable.svg)](https://packagist.org/packages/link0/profiler-bundle)
[![Total Downloads](https://poser.pugx.org/link0/profiler-bundle/downloads.svg)](https://packagist.org/packages/link0/profiler-bundle)
[![License](https://poser.pugx.org/link0/profiler-bundle/license.svg)](https://packagist.org/packages/link0/profiler-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/link0/ProfilerBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/link0/ProfilerBundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/link0/ProfilerBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/link0/ProfilerBundle/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/link0/ProfilerBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/link0/ProfilerBundle/build-status/master)

This repository wraps the `Link0/Profiler` package in a nice Symfony2 bundle, hooked to events for starting and stopping the profiler

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require link0/profiler-bundle "~0.1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Link0\ProfilerBundle\Link0ProfilerBundle(),
        );

        // ...
    }

    // ...
}
```
