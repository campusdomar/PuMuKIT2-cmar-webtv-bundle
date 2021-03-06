PumukitCmarTVBundle AdminGuide
==============================

Description
-----------

CmarWebTVBundle extends from WebTVBundle. This bundle needs you to have an Opencast server and a CAS server.


How to enable and configure this bundle
---------------------------------------

1.- Enable Cmar bundles (WebTVBundle, SonarBundle and LiveBundle) by uncommeting the following line in the `app/AppKernel.php` file of your project:

```
$ cd /path/to/pumukit2
$ php app/console pumukit:install:bundle Pumukit/Cmar/WebTVBundle/PumukitCmarWebTVBundle
```

2.- Add your Opencast server configuration to your `app/config/parameters.yml` files:

```
    opencast_host: ''
    opencast_username: ''
    opencast_password: ''
    opencast_player: ''
```

   - `opencast_host` is the Opencast server URL (Engage node in cluster).
   - `opencast_username` is the name of the account used to operate the Matterhron REST endpoints (org.opencastproject.security.digest.user).
   - `opencast_password` is the password for the account used to operate the Matterhorn REST endpoints (org.opencastproject.security.digest.pass).
   - `opencast_player` is the Opencast player URL or path (default /engage/ui/watch.html).


3.- Add your CAS server configuration to your `app/config/parameters.yml` files:

```
pumukit_cmar_web_tv:
    cas_url: ''
    cas_port: ''
    cas_uri: ''
    cas_allowed_ip_clients:
        - ''
        - ''
```

   - `cas_url` is the hostname of the CAS server.
   - `cas_port` is the port the CAS server is running on.
   - `cas_uri` is the URI the CAS server is responding on.
   - `cas_allowed_ip_clients` is an array of allowed IPs of the clients.


4.- Go to root Pumukit2 folder and init bundle tags

```
$ cd /path/to/pumukit2
$ php app/console podcast:init:tags --force
$ php app/console sonar:init:tags --force
$ php app/console webtv:init:tags --force
```

5.- OPTIONAL: Add locales. By default, Pumukit2 brings Spanish and English as locales. For CMAR there is Galician translation file as well. You can add Galician in your `app/config/config.yml` file from root project directory:

```
parameters:
    pumukit2.locales:
        - es
        - gl
        - en
```


8.- OPTIONAL: Add intro. Configure the video intro for CMAR with the URL of the video in your `app/config/config.yml` file from root project directory:

```
parameters:
    pumukit2.intro: 'http://{URL of the video}'
```

9.- Clear chache and install assets. Go to root Pumukit2 folder:

```
$ cd /var/www/pumukit2
$ php app/console cache:clear
$ php app/console cache:clear --env=prod --no-debug
$ php app/console assets:install
```