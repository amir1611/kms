# E-MUNAKAHAT
ONLINE MARRIAGE MANAGEMENT SYSTEM FOR PAHANG STATE GOVERNMENT


## Install

To clone this project
```bash
    1. Open the Terminal in Laragon.
    2. Make sure the current directory is '/www'.
    3. Type in 'git clone <url> <project-name>'.
    4. Type in 'cd <project-name>' to enter the project's directory.
```

To setup this project
```bash
    1. Make sure the current directory is '/<project-name>'.
    2. Type in 'composer install' to install the packages and dependencies.
    3. Click on Database in Laragon.
    4. Create a new database with the name of your project. Eg: <project_name>
    5. Type in 'code .' to open the current directory in VS Code.
    6. In the explorer tab on the left, copy the '.env.example' file and paste it in the same directory.
```

To publish this project
```bash
    1. Open the copied file and rename it to '.env'.
    2. In the '.env' file, edit the 'DB_DATABASE' value to the new Database name that you   have created.
    3. If your MySQL is using a password, edit the 'DB_PASSWORD' value with your password.
    4. In the Terminal, type in 'php artisan key:generate' to generate the project's 'APP_KEY'.
    5. Finally, type in 'php artisan migrate:fresh --seed' to migrate the database tables for the project.
```

## Deploy
Deploy with npm
```bash
  1. npm install 
  2. php artisan serve
  3. npm run dev
```
    
## Download
 - [Laragon](https://laragon.org/download/)
 - [Visual Studio Code](https://code.visualstudio.com/download)


## Appendix
Developed and Deployed using Visual Studio Code, Laragon, Heidi SQL, Github.


## Authors
- [@Amir](https://github.com/amir1611)
- [@Chua](https://github.com/chua01)
- [@Sufian](https://github.com/pianburp)
- [@Alia](https://github.com/NikAlia910)
- [@Sharmaine](https://github.com/Shammene)

## Documentation
 - [Laravel](https://laravel.com/docs/10.x)
 - [Visual Studio Code](https://code.visualstudio.com/docs)

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
