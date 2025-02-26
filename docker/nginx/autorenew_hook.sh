#!/bin/sh

echo "SSL certificates have been renewed, restarting nginx"
nginx -s reload