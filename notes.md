project magazine


vendor
rr

category 
blank

namespace
magazine

bundle name
LyndaMagazineBundle


app/console # display all the options

app/console  generate:bundle --help

 app/console generate:bundle --namespace=rr/MagazineBundle


app/console cache:clear --no-warmup

generate entity

app/console doctrine:generate:entity

[vendor][bundlename][entityname] 

create database 

show table structure 
DESCRIBE tablename;

generate database schema

 app/console doctrine:schema:update --force


assosiaction doctrine, use collection for create assosiation 

app/console doctrine:schema:update --dump-sql
app/console doctrine:schema:update --force
app/console doctrine:generate:entities rr  # update all the entities 


generate controller base on the structure of entity

app/console generate:doctrine:crud --help

app/console generate:doctrine:crud 


Doctrine ENTITY MANAGER , doctrine service for manipulate 

presiste remove ($entity) after flush()

provide Repostiories 
fetches entity of a crtain class
$em->getRepository('NAMEFBUNDLE:ENTITY');



# template  -----------------

{% extends bundle:controller:template %}
src/Vendor/NameBundle?Resources/views/Controller/template.twig

specify a Relative path :
'@BundleName/Resources/plublic/css/custom/css'


add bootstrap and jquery

open the file in the root composer.js and add  under "require" 

        "twbs/bootstrap": "3.2.*",
        "components/jquery": "1.9.*"

execute in the shell this for download the libraries  :
composer update

dump the usset under the public folder
app/console assetic:dump 


special tag stylesheets 

  {% block stylesheets %}
            {% stylesheets filter='cssrewrite' 
                '%kernel.root_dir%/../vendor/twbs/bootstrap/dist/css/bootstrap.css'
                '%kernel.root_dir%/../vendor/twbs/bootstrap/dist/css/bootstrap-theme.css'
                '@rrMagazineBundle/Resources/public/css/custom.css'
                %}
                <link rel='stylesheet' href='{{asset_url}}' />
                {% endstylesheets %}
        {% endblock %}


 filter='cssrewrite'  update the path correctly 
 asset_url is a special print 







