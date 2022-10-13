# Aloware assessment

Hi.

This assessment asked to create a simple Blog Post application that allows commenting. Comments can also be commented but up to the 3rd layer only.

If you need to see the requirements of this assessment, please access the project root folder, then go to `assets` folder, you'll see two files:
- PDF file: it contains all the information for developing the assessment
- Postman Collection: it's useful if you want to test manually using [Postman application](https://www.postman.com/)

### Programming language & Database
- Laravel
- MySQL

### Infrastruture
- Docker
- ShellScript

## Development accesses
In the scripts folder you'll find three shellscripts: `up.sh`, `down.sh` and `clear.sh`. Each of them has the respectively functions:
- `up`: start up all development services
- `down`: stop up all development services
- `clear`: delete all development resources such as: containers, volumes, networks and images

### MySQL
- url: localhost:3306
- credentials
    - user: zero
    - password: secret
