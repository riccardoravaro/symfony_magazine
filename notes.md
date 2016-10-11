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





