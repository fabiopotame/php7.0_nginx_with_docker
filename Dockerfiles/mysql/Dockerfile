FROM debian

MAINTAINER Fabio Potame <fabiopotame@gmail.com>

RUN apt-get update && apt-get -y install mysql-server

EXPOSE 6603 3306

CMD ["/usr/bin/mysqld_safe"]