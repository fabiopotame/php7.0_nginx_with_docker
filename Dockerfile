FROM debian

MAINTAINER Fabio Potame <fabiopotame@gmail.com>

# atualiza o repositorio
RUN apt-get update \
    && apt-get install -y nginx php7.0-fpm \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log \
    && apt-get clean

# configura o ngnix
ADD ./nginx.conf /etc/nginx/sites-enabled/default

#expoe a pota especificada para dentro do container
EXPOSE 80

CMD /etc/init.d/php7.0-fpm start && nginx -g "daemon off;"