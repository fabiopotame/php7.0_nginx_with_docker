# PHP 7.0 com Mysql
Docker com PHP 7.0 com nginx e Mysql
 
Necessário ter Docker instalado.



#### Comando para executar o docker-compose (executar na pasta onde se encontra o arquivo docker-compose.yml)

$ sudo docker-compose up -d

#### Recria os containers e builda a imagem novamente.

$ sudo docker-compose up -d --force-recreate --build

 
 
 
# Comandos do Docker

#### Exibe todos os container
$ sudo docker ps -a

#### Exibe todos os volumes
$ sudo docker volume ls

#### Exibe todas as imagens
$ sudo docker images -a

#### Pausa todos os container
$ sudo docker ps -a -q  | xargs sudo docker stop

#### Remove todos os container
$ sudo docker ps -a -q  | xargs sudo docker rm

#### Remove todas as imagens
$ sudo docker images -q |xargs sudo docker rmi

#### Remove todos os volumes
$ sudo docker volume ls -qf dangling=true | xargs -r sudo docker volume rm

#### Remove tudo
$ sudo docker ps -a -q  | xargs sudo docker stop -f && sudo docker ps -a -q | xargs sudo docker rm -f && sudo docker images -q |xargs sudo docker rmi -f && sudo docker volume ls -qf dangling=true | xargs -r sudo docker volume rm -f

