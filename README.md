# CINQ Backend PHP Test

## Setting up
```bash
git clone git@github.com:diogocavilha/php-test.git phptest
cd phptest/

# The whole project was built over a docker environment.
# So we need to create the docker image by running the following command.
docker build . -t tuxmate/php:testing

# After that, we can run the following command to configure all we need to start using the project.
make configure
 # command...
```

## Available Ports

Porta  | Aplicação
------ | -----------------
8081   | API
8080   | Front-end
9092   | PHPMyAdmin

## Database Access

Usuário | Senha
------- | ----------
root    | admin
