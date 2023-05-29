# This is a WordPress project Recruitment-Task

### Nesesary Plugin for this theme
- [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/)
**Note:** Without Advanced Custom Fields PRO plugin the theme will not work properly.

#### Dowlnoad the zip file from here [Download Zip File](./your-zip-file.zip) or you can download from the github repository.
Install the theme in your Wordpress instance and activate it.

## Theme Instructions

### header Instructions

##### Menu 
- Go to Appearance > Menus and create a new menu assigning it to the primary menu location.
##### Logo
- Go to Appearance > Customize > Header Image
##### To add site title
- Go to Appearance > Customize > Site Identity > Site Title
##### To add button in the header
- Go to Appearance > Customize > Header > Add Header Button

### Footer Instructions

##### To add footer menu
- Go to Appearance > Menus and create a new menu assigning it to the footer menu location.
- Go to woedpress dashboard > Very bottom left corner > you will see a settings icon > click on it > It'll takes you to footer settings > add footer items
**Note:** The footer has an ON & OFF checkbox to show and hide the footer.

### Home Page Instructions

- Go WordPress dashboard > Settings > Reading > Your homepage displays > A static page (select below) > Homepage: Home
- Create a new page as Home
 
##### To use resuable gutenburg block
- Homepage > Add Block > Search for "Home Hero Sections" > Select "Home Hero Sections" > You will find all of the necessary settings to use for the middle section for the home page > Publish the page



## Necessary for development

* node - v14.16.0
* npm - ^8.3.0
* [Local by Flywheel](https://localwp.com/)
* [Composer](https://getcomposer.org/)

## Development Setup
- Within Local by Flywheel (Local) add a new site
    - Site name: example
    - Local site domain (should fill automatically): example.local
    - Local site path: up to you
    - Create site from blueprint? : Don't use a blueprint
    - Choose your environment: Custom
    - PHP Version: 7.4.1 (or higher)
	- Web Server: Apache 2.4.43 (or higher)
    - MySQL 8.0.16
- This project manages WordPress core and plugins with composer, but we need to replace the WordPress Core installation that Local adds by default
    - Open Terminal and move to the project root `cd ~/path/to/root/[project name]`
    - Wordpress is installed at `app/public/`, so to remove and replace
    - `cd app`
    - `rm -rf public`
    - `mkdir public`
    - `cd public`
    - clone the repo into the public folder
        - *Notice the `.` at the end of the above command
- Install Composer and NPM
    - `composer install`
    - `npm install`
- Enable SSL
    - In Local on the Overview tab, there is a line for SSL
    - Click the "Trust" link, which will prompt for your password
    - The link should be replaced with "Trusted" preceded by a checkmark

### Import DB (if available)
- Import the database
    - There is a starter file at `database/setup.sql`
    - Ask for a more recent dump in the project channel if necessary and add it to `database`
    - From the Local dashboard, right click on the project name under Local Sites
    - Open Site Shell
    - Import a copy of the database `mysql -u root -proot -f local < database/[filename.sql]`
- Replace URLs in the DB (keep the site shell open)
    - Local utilizes Adminer (formerly phpMinAdmin)
    - From the Local dashboard, select the relevant project > Database > Adminer
    - Select the `wp_options` table
    - The URL to replace is the value for `siteurl`
    - `wp search-replace 'http://yoursite.com' 'https://example.local'`

### Fresh Install (no import db)
- Log in and activate the example theme

### URLs
 - Frontend: https://example.local/
 - Backend: https://example.local/wp/wp-admin/

### Build Scripts
- Build scripts are available with npm
    - See package.json in the repo root for details