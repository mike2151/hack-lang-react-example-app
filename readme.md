# Hack-Lang-Example-React-App
 
Simple example app that uses React with Hack. Project is used to demonstrate that React can be used with Hack server side rendering. 

## How It Works

Hack is great at using XHP to do server side rendering. However, XHP is limited in that it does not support React right out of the box. Therefore, in this project, I have a React instance that connects to a Hack application that serves XHP. This XHP is then parsed and converted into React components. The XHP code has a special tag class (`react-component`) that passes data to React, which then creates the corresponding React Component (in this case, the Greeting component). 

To install HHVM and Hack, see [installation](https://docs.hhvm.com/hhvm/installation/introduction)

Read more about XHP [here](https://docs.hhvm.com/hack/XHP/introduction)

Read more about React [here](https://reactjs.org/)

## Hack

### Running The Server 

First, cd into the hack folder: `cd hack`

### Install dependencies (Using [Composer](https://getcomposer.org/)):

`composer install` 

#### Run Autoload:

`vendor/bin/hh-autoload`

#### Run:

`hhvm -c config.ini -m server -p 8080`

**NOTE:**
If you are using Linux, you need to edit the configuration file to replace any instance of `/usr/local/etc/hhvm/` with `/etc/hhvm/`

The server will then be running on port 8080. However, you will interface with React.

## React

### Install Dependencies

First, cd into the react folder: `cd react-app`

Then, run `yarn install` to install dependencies

### Running the server

Run `yarn start` and you will be able to view the final frontend code at `localhost:3000` (make sure the Hack server is also running at the same time)

