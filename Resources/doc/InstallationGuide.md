Installation
------------

Steps 1 and 2 requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.


### Step 1: Introduce repository in the root project composer.json

Open a command console, enter your project directory and execute the
following command to add this repo:

```bash
$ composer config repositories.pumukitcmarwebtvbundle vcs
https://github.com/campusdomar/PuMuKIT2-cmar-webtv-bundle.git
```


### Step 2: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require campusdomar/pmk2-cmar-webtv-bundle dev-master
```


### Step 3: Install the Bundle

Install the bundle by executing the following line command. This command updates the Kernel to enable the bundle (app/AppKernel.php) and loads the routing (app/config/routing.yml) to add the bundle routes\
.

```bash
$ php app/console pumukit:install:bundle Pumukit/Cmar/WebTVBundle/PumukitCmarWebTVBundle
```

### Step 4: Update assets

```bash
$ php app/console cache:clear
$ php app/console cache:clear --env=prod
$ php app/console assets:install
```
