# Introduction
This demo shows running Openshift pipeline (tekton) with Kata contianers

## Deployment
Update registry-secret.yaml with base64 encoded value of `./docker/config.json`

```
kubectl apply -f ns.yaml
kubectl apply -f registry-secret.yaml
kubectl apply -f kaniko-task.yaml
kubectl apply -f build-push-pipeline.yaml
```

### Execute the pipeline
```
kubectl apply -f pipelinerun.yaml
```
Check the logs for progress
