FROM nginx:1.17-alpine

RUN apk add --no-cache curl

COPY ./common/nginx/swagger /etc/nginx/conf.d

WORKDIR /app
