# Hack-Lang-Example-React-App
 
Example app that uses react with Hack. 

To install HHVM and Hack, see [installation](https://docs.hhvm.com/hhvm/installation/introduction)

Read more about XHP [here](https://docs.hhvm.com/hack/XHP/introduction)

## Running The Server

### Install dependencies (Using [Composer](https://getcomposer.org/)):

`composer install` 

### Run Autoload:

`vendor/bin/hh-autoload`

### Run:

`hhvm -c config.ini -m server -p 8080`

**NOTE:**
If you are using Linux, you need to edit the configuration file to replace any instance of `/usr/local/etc/hhvm/` with `/etc/hhvm/`

The server will then be running on port 8080

Visit: `localhost:8080`
