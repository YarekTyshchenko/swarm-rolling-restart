build:
	docker build -t dummyapp ./dummyapp/

.PHONY: stop-normal
stop-normal:
	-docker rm -vf foo

.PHONY: normal
normal: stop-normal
	make build; docker rm -vf foo; docker run --name foo -d -p 80:80 dummyapp

.PHONY: stop-swarm
stop-swarm:
	-docker stack rm t

.PHONY: swarm
swarm: stop-swarm
	make build; docker stack deploy -c docker-compose.yml t

.PHONY: run
run:
	docker run --rm -it dummyapp bash

clean:
	docker rmi dummyapp

PHONY: build clean
