docker build . -t ci4-kubernetes
docker tag ci4-kubernetes 127.0.0.1:5100/ci4-kubernetes:1.2
docker push 127.0.0.1:5100/ci4-kubernetes:1.2

# cd codeigniter4

kubectl apply -f ./kube/php.yaml
kubectl apply -f ./kube/ci4-secret.yaml
kubectl apply -f ./kube/ci4-mysql.yaml
kubectl apply -f ./kube/ci4-phpmyadmin.yaml




## sudo chmod -R 777 ./script.sh