# ANGULAR CONTAINER
#
#

FROM node:10.15.3-stretch

EXPOSE 3000

WORKDIR /var/www/application

COPY . .

RUN npm i -g @angular/cli

RUN npm install

ENTRYPOINT ng serve --host 0.0.0.0 --port 3000 --prod