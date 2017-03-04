# EasyReheat
EasyReheat will tell you exactly how long the food needs to be microwaved. It uses Computer Vision to detect food types and uses Machine Learning to improve overtime.

EasyReheat is also avaliable via Azure Bot Service.

## Quick Start
EasyReheat uses Docker to deploy. Please make sure you have Docker installed.

* `cd` into the repository.

* Build a docker image by typing: `docker build -t easy-reheat .`
Wait for it to build. Upon completion You should see something like this:
```sh
Successfully built 5c9bae304424
SECURITY WARNING: You are building a Docker image from Windows against a non-Windows Docker host. All files and director
ies added to build context will have '-rwxr-xr-x' permissions. It is recommended to double check and reset permissions f
or sensitive files and directories.
```
Ignore the security warning and proceed.

* Run the docker container by typing
```sh
docker run -d -p local_port_you_wish_to_map:80 -v abs_path_to_src:/var/www/html easy-reheat
```

* Now check to see if the docker container is running by typing `docker ps`, you should see something like this:
```sh
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                  NAMES
8072921058db        easy-reheat         "/usr/sbin/apachectl "   3 minutes ago       Up 3 minutes        0.0.0.0:8081->80/tcp   gloomy_goldwasser
```

* You should now be able to access the app by going to `localhost:local_port_you_wish_to_map`

## Configuration
EasyReheat needs to be configured.

First, modify `src/config.php`
```php
<?php
    // Gloabl Configuration File
    namespace EasyReheat;
    class GlobalConfig {
        // Development mode, turn this off in production env.
        public static $dev_mode = true;
    }

    class ApiConfig {
        // Computer Vision API key (Microsoft)
        public static $cv_key = "ede4019e77124fa495407438f3e2c9d4";
    }
?>
```

Then, create a directory called `images` in `src/api`
