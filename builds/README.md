# Introduction
This demo shows building of container images inside Kata contianers

## Deployment
```
kubectl apply -f ns.yaml
```
### Sample container image build using kaniko
```
kubectl apply -f kaniko-build.yaml 
```

View the container logs to see the progress of the builds

### Sample buildah environment for container builds
```
kubectl apply -f buildah.yaml
```

Connect to the container shell to run buildah commands.
```
kubectl -n kata-builds exec -it buildah bash
```

Run the following commands in the container shell
```
mkdir /build && cd /build
cat  <<EOF | tee Dockerfile
FROM quay.io/fedora/fedora:33
RUN date
EOF

buildah bud --storage-driver vfs -f Dockerfile .
```


