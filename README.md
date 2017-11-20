nacat-backend
=============

Nacat utilizes [QuReP](https://github.com/solazs/qurep) to provide the API.

[FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) is used for basic user management.
Note: registration is enabled for editors only.

The `nacat:editor:create` command may be used to add editors without logging in first.
 

[LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle) is used to provide JWT Authentication.

Installation
------------

The project depends on Composer to manage dependencies. Install them right away:

`composer install`

Composer will provide information about the needed PHP environment, too.

Configuration
-------------

Generate the keypair for JWT:

```
mkdir -p var/jwt
openssl genrsa -out var/jwt/private.pem -aes256 4096
openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```

Review configuration parameters in app/config/parameters.yml

Create your first user by invoking the `nacat:editor:create` command:

`php bin/console nacat:editor:create`

and follow the on-screen instructions.
