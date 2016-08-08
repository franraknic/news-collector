#!/bin/ash

set -e

# generate host keys if not present
ssh-keygen -A

exec "$@"
