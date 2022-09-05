docker build . -t ci4-kubernetes
docker tag ci4-kubernetes 127.0.0.1:5100/ci4-kubernetes:1.2
docker push 127.0.0.1:5100/ci4-kubernetes:1.2

kubectl apply -f ./kube/php.yaml




## sudo chmod -R 777 ./script.sh