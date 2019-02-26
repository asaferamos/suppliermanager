#!/bin/bash


if [ -z "$@" ] ; then
    ARG="--help"
else
    ARG="$@"
fi

for i in $ARG
do
    case $i in
        --build)
            echo $'\nBuilding Supplier Manager by Asafe Ramos...\n'
            sudo docker-compose up -d

            echo $'\nInstall dependencies for api...\n'
#            sudo docker exec -it supplier_php bash -c 'apt-get update && apt-get install zip git -y'
            sudo docker exec -it supplier_php composer install

            echo $'\nInstall dependencies for client...\n'
#            sudo docker exec -it supplier_client npm install

            echo $'\nRun migrate on api laravel...\n'
            sudo docker exec -it supplier_php php artisan migrate
            sudo docker exec -it supplier_php php artisan migrate --database=test

            echo $'\nRun tests on api laravel...\n'
            sudo docker exec -it supplier_php vendor/bin/phpunit

            echo $'\nStart service client...\n'
#            sudo docker exec -it supplier_client yarn start

            sudo docker ps | grep supplier_
        shift
        ;;
        --start)
            echo $'\nStarting Supplier by Asafe Ramos...\n'
            sudo docker-compose up

            sudo docker ps | grep supplier_
        shift
        ;;
        --stop)
            echo $'\nStopping Supplier Manager by Asafe Ramos...\n'
            sudo docker-compose down

            sudo docker ps -a | grep supplier_
        shift
        ;;
        --restart)
            echo $'\nStopping MyShop by Asafe Ramos...\n'
            sudo docker-compose down

            echo $'\nStarting MyShop by Asafe Ramos...\n'
            sudo docker-compose up -d

            sudo docker ps -a | grep supplier_
        shift
        ;;
        --update)
            echo $'\nUpdating dependencies for api...\n'
            sudo docker exec -it supplier_php composer update
        shift
        ;;
        --migrate)
            echo $'\nRun migrate on api laravel...\n'
            sudo docker exec -it supplier_php php artisan migrate
        shift
        ;;
        --test)
            echo $'\nRun tests on api laravel...\n'
            sudo docker exec -it supplier_php vendor/bin/phpunit
        shift
        ;;
        --help)
            echo $'
            supplier.sh [--build] [--start] [--stop] [--restart] [--update] [--migrate] [--test] [--help]

            Development by Asafe Ramos

            --build\tbuild a docker and run composer install
            --start\tstart and up a docker image
            --stop\tstop a docker image
            --restart\trestart a docker image
            --migrate\trun laravel migrate on api
            --test\trun laravel tests on api
            --update\trun composer update'
        shift
        ;;
    esac
done