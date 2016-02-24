# Reorg-test website

This is an application built by Patrick Archer.  It is built using PHP, Laravel Framework, Angularjs, MYSQL. So you have to have these applications configured on your webserver at the minimum. Once that is done, you just have to configure your environment(.env) file..  

## Installation Instructions





2.  Copy the application down to your local drive.  Edit your webservers config file(httpd.conf for apache) and add a virtual host for this application.  Your Documentroot is '/public'.  For apache it would look something like this:

		<VirtualHost *:80>
		    ServerAdmin webmaster@reorg.mac
		    DocumentRoot "/www/vhosts/reorg/public"
		    ServerName reorg.mac
		 
		    ErrorLog "logs/reorg.mac-error_log"
		    CustomLog "logs/reorg.mac-access_log" common
		</VirtualHost>

   You need to edit the parameters to match your configuration.

2. Import the database\reorg.sql file into your mysql db.  This will create your database with all table structures .  Then create a user for the reorg-test database name 'dbUser'.  Use 'AxJGKXDaYvMdwK7v' as the password for the db user.  If you change these values, make sure you edit the env_example file.

3. Open the env_example file in the root of the app directory and change the environment variables.  At minimum update the OPEN_DATA_APP_KEY. Then rename env_example to .env


4. There is also a script that that updates the db with data from open payments when the app first opens and every 30 seconds when the search page is open.  This script can be run by a cron job also.  The url is "/gd".

5.  Navigate to your homepage after that and you are good to go.




## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
