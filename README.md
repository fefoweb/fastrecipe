fastRecipe
==========

A Symfony project to manage Recipe in fast and useful ways!


#### To Build

1) $> git clone repository

2) $> cd fastRecipe/

3) $> composer install

4) $> composer run cache-clean

5) Setting up permits for /var folder to your apache user

```shell
$> HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1` 
$> chmod -R +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" var
$> chmod -R +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" var
```

6) Install npm(if not installed on your system)

7) Install package required

```shell
$> npm install
```

8) Run client task with grunt

```shell
$> build:deploy
```

> Other task is managed in grunt/aliases.yaml 

#### To Run

###### Using Symfony built-in server

```shell
$> php bin/console server:start
```
> go to http://localhost:8000/

###### Configuring your local web server (example Apache)

Editing your httpd-vhost.conf

```shell
<VirtualHost *:80>
    ServerName recipe.demo
    ServerAlias recipe.demo

    DocumentRoot "<web>/fastRecipe/web"
    <Directory <web>/fastRecipe/web>
        AllowOverride All
        Order Allow,Deny
        Allow from All
    </Directory>

    ErrorLog "/private/var/log/apache2/recipe-error_log"
    CustomLog "/private/var/log/apache2/recipe-access_log" combined
</VirtualHost>
```

Editing /etc/hosts

```shell
127.0.0.1 recipe.demo
```

Restarting Apache service

> go to http://recipe.demo/

This is a minimal configuration, using for simple start porpouse!

####Enjoy!
