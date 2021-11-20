# Introduction
This demo deploys a simple echo webserver.
The `Route` object is specific to OpenShift clusters.

## Deployment
```
kubectl apply -f ns.yaml
kubectl apply -f web.yaml 
```

## Get the routes
```
kubectl get routes -n kata-webserver -ojsonpath='{range .items[*]}{.spec.host}{"\n"}{end}' 
```

This will print the route urls created. Example o/p from my test cluster:
```
echo-route-kata-webserver.apps.dev.k8s.com
```

## Access the webserver

The URL will be of the form: `https://<route>`

eg. `https://echo-route-kata-webserver.apps.dev.k8s.com`

```
curl -k https://echo-route-kata-webserver.apps.dev.k8s.com
Hello from Kata container
```

## Scale the Deployment

Scale the number of replicas to show multiple Kata PODs getting created,
each POD running within a separate Qemu instance
```
kubectl scale --replicas=2 deployment/echo-kata
```
