# Skully Project - A skeleton project for [Skully Framework](http://github.com/triodigital/skully)

Read about Skully Framework [here](http://github.com/triodigital/skully).

## Features & Behaviours of a Skully project
- Project may consist of only a single main Application (Skully\Application) as an entry point of web requests.
- Full support in testing with PHPUnit (hence no Singletons).
- Configuration class may be attached into this application (Skully\Core\Config).
- Environment-awareness:
    - App is accessible from anywhere:
        - In Controllers and Models app can be accessed with $this->app.
        - On places not directly connected with app, e.g. library classes and PHPUnit tests, you
          can include the app's bootstrap file, then do the following
          ```PHP
          $app = __setupApp();
          ```
          If you wish to setup the app with a different config you can do so by doing the following:
          ```PHP
          $config = new \App\Config\Config(); // which is inherited from \Skully\Core\Config.

          setCommonConfig($config);
          setUniqueConfig($config);
          $app = new \App\Application($config);
          ```
    - App may "see" controllers ($app->getController('another')).
    - App may create models ($app->createModel('model')).
    - App may utilise other classes in \Skully\Core\* refer to \Skully\ApplicationInterface to figure out which classes are available and how to access.
- Routing with rules like:
    - "pages/list" => "pages/index"
    - "pages/%id" => "pages/view"
    With above rules, http://yoursite/pages will run controller "PagesController" action "index", and http://yoursite/pages/1 will
    run controller "PagesController" action "view" and pass id=1 into it.
    Routes are adjustable from within config/config.common.php.
- Support for multiple languages with which you can access the site with http://yoursite/en/pages and it will use language
  "en" on your site.
- You can create your own helpers. inside \App\Helpers\ directory. Review some of prepared helpers there.
  Also check on \Skully\App\Helpers\UtilitiesHelper and \Skully\App\Helpers\FileHelper for some useful helper functions.
- Views are stored inside themes directory along with resources and languages, divided by apps,
  this allows for:
    - Different themes to have entirely different displays (i.e. Christmas sale, normal period, etc.).
    - Different apps to have different set of languages and resources, and languages for one app
      not getting loaded when loading another app.
- Easy to use CRUDController to create a standardized CRUD pages (area with Create, Read, Update, Delete features on the app's database).

## Documentation & How-Tos

### Many-to-Many on CRUD Controller
Suppose there are three tables:
- book
    - id
    - title
- author
    - id
    - name
- bookauthor
    - id
    - book_id
    - author_id

How is the fastest way possible to add a set of pages to manage bookauthor table?

Here is the idea:
1. Book Model: Add a public function to set bookauthors here
2. BookController Controller: Override method afterUpdateSuccess to set bookauthors.
3. _editForm.tpl View: Add the multiple selector here.

Code references:
1. Book Model
   ```PHP
       public function setAuthors($authorIds)
       {
           R::exec("DELETE FROM bookauthor WHERE book_id = ?", array($this->get('id')));
           if (!empty($authorIds)) {
               foreach($authorIds as $authorId) {
                   R::exec("INSERT INTO bookauthor (book_id, author_id) values(?, ?)", array($this->get('id'), $authorId));
               }
           }
       }
   ```
2. BooksController Controller

   ```PHP
       /**
        * @param \App\Models\Book $instance
        */
        protected function afterUpdateSuccess($instance) {
            $instance->setAuthors($this->getParam('bookauthors'));
        }
   ```
3. _editForm.tpl View

   ```Smarty
   <div class="row-form">
   <div class="span2"><label for="roomamenities">Amenities:</label></div>
       <div class="span10">
           <select name="roomamenities[]" id="roomamenities" multiple="multiple" class="msc">
               {foreach from=$allAmenities item=amenity}
                   <option value="{$amenity.id}" {if (in_array($amenity.id, $roomamenities))}selected{/if} >{$amenity.title|translate:"en"}</option>
               {/foreach}
           </select>
       </div>
   </div>
   ```

### Cron
Opens a file that lists all cron jobs, which you can use to create, edit, and delete crons:
crontab -e

Running the cron every 3 minutes:
*/3 * * * * php /basePath/app/crons/base.php siteName.com

base.php will run other crons.
