FROM registry.zanox.com/zanox/php53:centos-6.6

# Install dependencies
RUN yum install -y -q openssh-clients tar git-core wget \
      php53u-devel gcc && \
    yum clean all


# Install S6
RUN curl -sL "https://github.com/just-containers/s6-overlay/releases/download/v1.18.1.5/s6-overlay-amd64.tar.gz" | tar xz -C /

# this signal should make apache do a graceful stop
#STOPSIGNAL SIGWINCH
WORKDIR /home/sites/darwin.affiliatewindow.com/web
COPY index.php ./

#HEALTHCHECK --interval=2s CMD curl -f http://localhost

COPY s6/services.d /etc/services.d
COPY s6/init-stage1 /etc/s6/init-no-catchall/init-stage1
COPY s6/SIGTERM /etc/s6/services/.s6-svscan/
COPY s6/SIGHUP /etc/s6/services/.s6-svscan/
WORKDIR /etc/s6/services/.s6-svscan/
RUN ln -s SIGTERM SIGINT
RUN rm /etc/httpd/conf.d/welcome.conf

COPY config/apache/darwin.conf /etc/httpd/conf.d/darwin.conf
COPY config/apache/httpd.conf /etc/httpd/conf/httpd.conf

ENV DWIN_PLATFORM=production
ENV DWIN_DATACENTRE=lhr1
ENV DWIN_BRAND=awin
ENV DWIN_DEV_SERVER=
RUN mkdir -p /srv/log/darwin-docker/

EXPOSE 80
EXPOSE 444
EXPOSE 8080

CMD ["/init"]