# ANGULAR CONTAINER
#
#

FROM node:10.15.3-stretch

EXPOSE 3000

WORKDIR /var/www/application

COPY . .

RUN npm i -g @angular/cli

RUN npm install

RUN ng serve --prod --port 3000
