# Graceful shutdown and rolling up date with Docker Swarm

To try it out.

 * Make sure your host is running in swarm mode (if not `docker swarm init`)
 * `make build` to build the images
 * `make normal` to start normal way
 * `make swarm` to start in swarm way
 * wait for them to start-up (use `docker ps` to monitor)

Once everything is running issue a request: `curl http://$DH.dev.awin.com/?sleep=1`

Then attempt to shutdown the stack, normal: `docker stop -t 9999 foo` or swarm `docker stack rm t`

Watch `htop` on the docker host, what you should see is a SIGWINCH issued to Apache process, then only one of its children stays around to service the last request. This situation should be maintained indefinitely, until you quit curl and the connection is freed up. Child exits, then whole container exits, and process is complete.

Currently this works correctly using normal way, however, in swarm the connection gets dropped, increment stops incrementing, then after some time, presumably TCP timeout inside the container, apache child quits, and whole container stops.

Play around with issuing different signals to different parts of the stack. `s6-svscan` expects SIGTERM which it converts into a SIGWINCH for apache.

