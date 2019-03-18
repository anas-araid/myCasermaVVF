# myCasermaVVF

Management fire station webapp and Telegram Bot to be notified of firefighters' activities such as shifts, courses, etc.

### WebApp
* Manage firefighters
* Certifications 
* Fire vehicle
* Configure squads and shifts
* Courses
* Communications
* Fire calendars

### Telegram Bot
* Using Telegram mobile number auth (if fireman mobile number has been setup in firestation configuration)
* View your squad components and shifts
* Notification shifts
* Show current courses
* View your data

## Getting Started

These instructions will get you a copy of the project to running on your local machine for development and testing.

### Prerequisites
```
* xampp
```

### Installing

#### Set up your server

* Copy this repo into your xampp htdocs folder

#### Set up the database
* Start the XAMPP control panel (xampp-control.exe)
* From the control panel, start Apache and MySQL
* Click "Admin" for MySQL or navigate to localhost/phpmyadmin in your browser
* Copy "s-now/db/db.sql" file into SQL tab and run

#### Configuring
* Navigate to "Configura"
* Set firestation name, email, phone number and password
* Through side menu, all firestation resources could be configured 

```
In your browser, navigate to localhost/myCaserma and have fun...
```

## Built With

* [XAMPP](https://www.apachefriends.org/it/index.html) - Web server
* [PHP](http://php.net/manual/it/intro-whatis.php) - Scripting language
* [MDL](https://getmdl.io/) - Material Design Lite
* [Atom](https://atom.io/) - Atom text editor
* [Visual Studio Code](https://code.visualstudio.com/) - Visual Studio Code text editor

## Authors

* **Anas Araid** - [asdf1899](https://github.com/asdf1899)