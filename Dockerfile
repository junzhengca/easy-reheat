FROM ubuntu:xenial
MAINTAINER Jun Zheng

# Install packages
ENV DEBIAN_FRONTEND noninteractive

# Install apache2, php and git
RUN apt-get update && \
  apt-get install -y apache2 php libapache2-mod-php php-mcrypt php-mysql git

# RUN apt-get install -y mysql-server

RUN apt-get install -y supervisor
RUN systemctl enable supervisor


# Add image configuration and scripts
ADD docker_config/start-apache2.sh /start-apache2.sh

# Install mysql, don't need it yet
# ADD start-mysqld.sh /start-mysqld.sh

ADD docker_config/run.sh /run.sh
RUN chmod 755 /*.sh
# ADD my.cnf /etc/mysql/conf.d/my.cnf
ADD docker_config/supervisord-apache2.conf /etc/supervisor/conf.d/supervisord-apache2.conf
# ADD docker_config/supervisord-mysqld.conf /etc/supervisor/conf.d/supervisord-mysqld.conf

# Remove pre-installed database
# RUN rm -rf /var/lib/mysql/*

# Add MySQL utils
# ADD create_mysql_admin_user.sh /create_mysql_admin_user.sh
# RUN chmod 755 /*.sh

# config to enable .htaccess
ADD docker_config/apache_default /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Configure /app folder with sample app
# RUN git clone https://github.com/fermayo/hello-world-lamp.git /app
# RUN mkdir -p /app && rm -fr /var/www/html && ln -s /app /var/www/html

# Environment variables to configure php
ENV PHP_UPLOAD_MAX_FILESIZE 10M
ENV PHP_POST_MAX_SIZE 10M

# Add volumes for MySQL
# VOLUME  ["/etc/mysql", "/var/lib/mysql" ]

EXPOSE 80
# EXPOSE 3306

CMD ["/bin/bash", "/run.sh"]
