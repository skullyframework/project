Skully MVC

Skully MVC is an MVC framework focusing mainly on a better separation of directories for
collaborative work between web programmer and web designer.

With Skully MVC you may give access to just the public directory to web designers, and complete access
to the project's main programmers. Ideally This system would allow you to work remotely with multiple
team members.

Features:

1. RedBeanPHP as its ORM.
2. Javascript compressing tool.
3. Sass / Scss
4. Templating system supported by Smarty. Templates are also completely separated from rest of the project's code. This allows for work division between client and server developers.
5. Support for multiple websites in one project. Configuration files are kept within a shared directory.

Requirements:
- Project may consist of only a single main Application (Skully\Application) as an entry point of web requests.
- Full support in testing with PHPUnit (hence no Singletons).
- Configuration class may be attached into this application (Skully\Core\Config).
- Application may get any Controller (ControllerFactory::create).
- Controller has access to theme ($this->app->theme)

* Controller Requirements
- Controller needs to know which language

- Models may each have different db adapters, or even not attached to db.
- Views are stored inside themes directory along with resources and languages, divided by apps,
  this allows for:
  > Different themes to have entirely different displays (i.e. Christmas sale, normal period, etc.).
  > Different apps to have different set of languages and resources, and languages for one app
    not getting loaded when loading another app.
- Should helpers be tied to an application? Not physically, at least. For now lets define helpers
  outside Application, and pass Application instance only when needed.
  Lets make each helper as Singleton class.
- How about controllers?
- Shared classes are stored within library directory.
- Plugins managed by composer are stored within vendor directory.

Development roadmap:

1. Selenium for Integration testing.

-----------------------
Documentation & How-Tos
-----------------------

---Convert database to Entities---
cli-config must have:
$driver = new \Doctrine\ORM\Mapping\Driver\YamlDriver(array(
    BASE_PATH . 'App/Models/mapping'
));

$app->getDoctrineConfig()->setMetadataDriverImpl($driver);

First run:
./vendor/bin/doctrine orm:convert-mapping --from-database annotation App/Models/Mapping

Then update the resulting mappings to adjust table prefixes.
hint: PHPStorm's replace all feature helps, example:
  replace: (?-i)Donini([^\n]*)\n
  with: $1Mapping\n

  replace: \<\?php\n
  with: \<\?php\n\nnamespace App\\\\Models\\\\Mapping;

  replace: private $
  with: protected $

  replace: class
  with: trait

And finally, create the models for them and use generated entities as traits.

When got errors like:
Doctrine\ORM\Mapping\MappingException : Class "App\Models\Product" is not a valid entity or mapped super class.

That means in App\Models\Product you should add:

use Doctrine\ORM\Mapping as ORM;
and
* @ORM\Entity
as your class' doctype

---Cron---
Opens a file that lists all cron jobs, which you can use to create, edit, and delete crons:
crontab -e

Running the cron every 3 minutes:
*/3 * * * * php /basePath/app/crons/base.php siteName.com

base.php will run other crons.

---PHPUnit---
To run php unit via terminal, simply browse to /tests directory, then run:
./phpunit.phar unit/YourTest.php

---JS Packer---
This tool is used to pack your javascsripts into one large compressed file. This is really useful to optimize the speed
of your site.
To use this, open the terminal app, then browse to /tools/jspacker and run:
./pack /YOUR_THEME/packjs.txt
For example: ./pack /default/packjs.txt
Figure out how to pack by looking at that file, it's easy!

---SCSS---
SCSS is basically a CSS syntax on Steroids. You can do some logic, nesting, variables, and inclusion in your css
just like any programming language with this.
To use this, first you need to install compass (gem install compass),
then browse to /themes/YOUR_THEME/resources/scss and run:
compass watch
Then anything you write on site.scss will be converted to css file to use on your site.

---Database Migration / Ruckus---
Database migration tool similar to rails.
To use this, first configure it by editing /tools/configure.php
In that file, change 'online/path' to a path available on your server.
Read ruckusing documentation.

-----------------------
FAQs
-----------------------

---Why does the config stored inside shared/ dir?---
The original idea of this MVC is to allow multiple app with same configurations,
but somehow along the way it deviates from that.
The idea is to have app/, anotherApp/, etc. directories all accessing the shared directory.


------------------------
DATABASE SESSION PACKAGE
------------------------
1. Library Session
2. call library in Application.php see line 345 & 346

------------------------
CART PACKAGE
------------------------
1. Library Cart
2. Cart Controller // you can edit or make a new one
3. Library Session
4. Coupon