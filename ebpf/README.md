# Introduction
This demo shows spinning up alternate service using Kata containers for debugging or tracing 
a running application using privilege capabilities eg. using a sidecar for eBPF tracing.

This demo makes use of the [route-based deployment strategy](https://docs.openshift.com/container-platform/4.9/applications/deployments/route-based-deployment-strategies.html) available in Red Hat OpenShift.

## Deployment
```
kubectl apply -f ns.yaml
kubectl apply -f echo-runc.yaml 
```

## Get the routes
```
kubectl get routes -n kata-ebpf -ojsonpath='{range .items[*]}{.spec.host}{"\n"}{end}' 
```

This will print the route urls created. Example o/p from my test cluster:
```
echo-route-kata-ebpf.apps.dev.k8s.com
```

## Access the webserver

The URL will be of the form: `https://<route>`

eg. `https://echo-route-kata-ebpf.apps.dev.k8s.com`

```
curl -k https://echo-route-kata-ebpf.apps.dev.k8s.com
Hello from runc container
```

## Debug the application using privileged Kata sidecar

Deploy the application as a Kata POD with privileged side car and
create a new service

```
kubectl apply -f echo-debug-kata.yaml 
```

Update the `Route` of the application to redirect all traffic to the Kata POD

```
kubectl patch -n kata-ebpf route/echo-route --patch '{"spec":  {"to": {"kind": "Service","name": "echo-runc","weight": 0}, "alternateBackends": [{"kind": "Service","name": "echo-kata","weight": 100}]}}'
```

Verify that the traffic is routed to the Kata POD.
Example, on my test setup
```
curl -k https://echo-route-kata-ebpf.apps.dev.k8s.com
Hello from Kata container
```

Now you can connect to the shell of the sidecar and use eBPF to debug the primary application.

Once debugging is complete, you can update the `Route` to redirect all traffic to the 
regular POD and destroy the Kata POD.
