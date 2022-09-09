# Helm chart for codeigniter 4
Demo helm install codeigniter 4 app run on kubernetes


## Run app codeigniter 4 , mariadb and phpmyadmin

helm install ci4-test -f values-test.yaml ./ 

helm install ci4-dev -f values-dev.yaml ./ 

helm install ci4-prod -f values-prod.yaml ./ 

## Delete all

helm delete ci4-test           
helm delete ci4-dev
helm delete ci4-prod