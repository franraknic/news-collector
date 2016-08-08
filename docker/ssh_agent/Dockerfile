FROM alpine:3.2

ENV SOCKET_DIR /root/.ssh
ENV SSH_AUTH_SOCK ${SOCKET_DIR}/socket
RUN apk add --update openssh && rm -rf /var/cache/apk/*
COPY entrypoint.sh /entrypoint.sh
COPY known_hosts /root/.ssh/known_hosts
VOLUME ${SOCKET_DIR}
ENTRYPOINT ["/entrypoint.sh"]
CMD ["ssh-agent"]
