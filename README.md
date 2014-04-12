# Skully MVC

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

*Controller Requirements*
- Controller needs to know which language
- Models may each have different db adapters, or even not attached to db.
- Views are stored inside themes directory along with resources and languages, divided by apps,
  this allows for:
    - Different themes to have entirely different displays (i.e. Christmas sale, normal period, etc.).
    - Different apps to have different set of languages and resources, and languages for one app
      not getting loaded when loading another app.
- Should helpers be tied to an application? Not physically, at least. For now lets define helpers
  outside Application, and pass Application instance only when needed.
  Lets make each helper as Singleton class.
- How about controllers?
- Shared classes are stored within library directory.
- Plugins managed by composer are stored within vendor directory.

Development roadmap:

1. Selenium for Integration testing.

## Documentation & How-Tos

### Cron
Opens a file that lists all cron jobs, which you can use to create, edit, and delete crons:
crontab -e

Running the cron every 3 minutes:
*/3 * * * * php /basePath/app/crons/base.php siteName.com

base.php will run other crons.
