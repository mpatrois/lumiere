touch database/database.sqlite
projectPath=`pwd`
echo "APP_NAME=Lumiere
APP_ENV=local
APP_KEY=base64:ASZ0BY59FL3BxT/ZTx9FCUpKi5/goVFhLeRVKl+PTnE=
APP_DEBUG=true
APP_URL=http://localhost
DB_CONNECTION=sqlite
DB_CONNECTION=sqlite
DB_DATABASE=$projectPath/database/database.sqlite" > .env