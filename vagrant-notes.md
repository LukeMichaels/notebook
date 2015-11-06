
# Setting up a WordPress Vagrant Environment
VV installation instructions https://github.com/varying-vagrant-vagrants/vvv/

## Step one
`
vv create
`
inside the
`
~/vagrant-local/
`
folder, 


## Step 2 
Pull down the FTP copy of the site’s assets and stuff into what will likely be the
`
~/vagrant-local/www/lukemichaels/htdocs
`
folder, 


## Step 3 
Use the db migrate pro type plugin to get a copy of the db and install it on your local mysql with the appropriate name

‘
first row is dev server (i.e. needmore.dev)
second row is the root folder (i.e. /Users/luke/vagrant-local/www/needmore/htdocs)
‘
visit phpMyAdmin to import the DB.


## Step 4
Clone the git repo into what will then be your
`
~/vagrant-local/www/elkcove/htdocs/wp-content/themes/elkcove
`
folder,

‘
git clone https://github.com/YOUR-USERNAME/YOUR-REPOSITORY
‘


## Step 5 
use
`
npm install
`
and other tools as required to get your grunt/gulp workflow going.

## other notes

Create a new project
vv create

vv list – Lists all local sites.
vv create – Walks you through a wizard to create a new site.
vv delete – Walks you through removing a site.
