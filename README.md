# php7.0_nginx_docker-compose
Docker com PHP 7.0 com nginx

Exibe todos os container
$ sudo docker ps -a

Exibe todos os volumes
$ sudo docker volume ls

Exibe todas as imagens
$ sudo docker images -a

# CUIDADO AO EXECUTAR OS SEGUINTES COMANDOS
Pausa todos os container
$ sudo docker ps -a -q  | xargs sudo docker stop

Remove todos os container
$ sudo docker ps -a -q  | xargs sudo docker rm

Remove todas as imagens
$ sudo docker images -q |xargs sudo docker rmi

Remove todos os volumes
$ sudo docker volume ls -qf dangling=true | xargs -r sudo docker volume rm

