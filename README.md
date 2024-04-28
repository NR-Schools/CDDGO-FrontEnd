
# CDDGO Project

This is our IT135-8L Php Project for MTG Organization

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`DATABASE_HOST` = your database host

`DATABASE_NAME` = name of the database to be used

`DATABASE_USERNAME` = username, typically root

`DATABASE_PASSWORD` = your password

## Deployment

To deploy this project run:

*For those who have php installed*
```
  php -S localhost:8080

  Run this on project root
```

*For those using XAMPP*
```
  1. Go to XAMPP control panel
  2. Click Apache Config
  3. Select httpd.conf
  4. Find Document Root
    DocumentRoot "C:/xampp/htdocs"
    <Directory "C:/xampp/htdocs">
  5. Change both paths to C:/xampp/htdocs/*path to your project root*
  6. Restart Server
  
  4-6 is based on https://www.codehamster.com/tools/how-to-change-the-document-root-in-xampp-for-windows/
```