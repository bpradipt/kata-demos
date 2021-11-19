# Introduction
This demo publishes system info from the container.
The `Route` object is specific to OpenShift clusters.
Check the `container` folder for details on the container image used.

## Deployment
```
kubectl apply -f ns.yaml
kubectl apply -f runc-webserver.yaml 
kubectl apply -f kata-webserver.yaml 
```

## Get the routes
```
kubectl get routes -n kata-sysinfo -ojsonpath='{range .items[*]}{.spec.host}{"\n"}{end}' 
```

This will print the route urls created. Example o/p from my test cluster:
```
kata-webserver-route-kata-sysinfo.apps.dev.k8s.com
runc-webserver-route-kata-sysinfo.apps.dev.k8s.com
```

## Access the sysinfo stats
Access the sysinfo using a web browser and the following url
`https://<route>/stats.php`

eg. `https://kata-webserver-route-kata-sysinfo.apps.dev.k8s.com/stats.php`
