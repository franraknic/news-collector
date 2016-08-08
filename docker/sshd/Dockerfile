FROM alpine:3.3
MAINTAINER Davor Plehati <davor.plehati@trikoder.net>

RUN apk --update add openssh nmap \
  && sed -i s/#PermitRootLogin.*/PermitRootLogin\ yes/ /etc/ssh/sshd_config \
  && sed -i s/#AllowTcpForwarding.*/AllowTcpForwarding\ yes/ /etc/ssh/sshd_config \
  && sed -i s/#X11Forwarding.*/X11Forwarding\ no/ /etc/ssh/sshd_config \
  && sed -i s/#GatewayPorts.*/GatewayPorts\ yes/ /etc/ssh/sshd_config \
  && echo "root:root" | chpasswd \
  && rm -rf /var/cache/apk/*

COPY entrypoint.sh /entrypoint.sh

EXPOSE 22
EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]

CMD /usr/sbin/sshd -D -e
