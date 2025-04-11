# Full local set-up Instructions for Milestone 3

We didn't manage to migrate to the remote server in time for the deadline. This is mainly because we have a routing system for requests on our site, and this is partly handled by a `.htaccess` (Apache server config) file. The remote server does not appear to allow overrides, which prevents any of our requests from being routed correctly.

However, we worked hard to get the back-end functional. So in case we don't manage to do the migration soon, here are easy instructions for how to see our work on a local computer.

- [Full local set-up Instructions for Milestone 3](#full-local-set-up-instructions-for-milestone-3)
  - [Part 1 - Configure Virtual Host](#part-1---configure-virtual-host)
    - [1.1 Add a virtual host for this repository](#11-add-a-virtual-host-for-this-repository)
    - [1.2 Edit Your hosts File:](#12-edit-your-hosts-file)
      - [On Windows](#on-windows)
      - [On MacOS](#on-macos)
    - [1.3 The point](#13-the-point)
  - [Part 2 - Initialize Database](#part-2---initialize-database)
    - [2.1 start MySQL](#21-start-mysql)
    - [2.2 Open the MySQL admin dashboard](#22-open-the-mysql-admin-dashboard)
    - [2.3 Import our database](#23-import-our-database)
  - [Part 3 - Access the website](#part-3---access-the-website)

## Part 1 - Configure Virtual Host

I know for sure these steps work for Windows. I have added some notes for Mac too, but this video seems to be a good guide: [How to Configure Virtual Hosts in XAMPP on a Mac](https://www.youtube.com/watch?v=zRIa8-MF6pw).

### 1.1 Add a virtual host for this repository

Open your XAMPP's `httpd-vhosts.conf` file.
- On Windows: most likely `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
- on MacOS: I think it's `/Applications/XAMPP/etc/extra/httpd-vhosts.conf`

Add the following code to this file:
```
# Main host
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "C:/xampp/htdocs" #or whatever the quivalent path is on your computer
</VirtualHost>

# COSC 360 Project host
<VirtualHost *:80>
    DocumentRoot "<insert-absolute-path>/cosc-360-project/code/public"
    ServerName cosc-360-project.test
    <Directory "<insert-absolute-path>/cosc-360-project/code/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

> [!Important]
> You must replace `<insert-absolute-path>` with the absolute path to whereever you have cloned our repo on your computer (which can be anywhere you want).

> [!Note]
> You can name the virtual host server (here given as `cosc-360-project.test`) whatever you want. However, it is recommended that you use `.test` or another TLD that is guaranteed not to be used as an actual internet TLD.

### 1.2 Edit Your hosts File:

#### On Windows
- Open the file `C:\Windows\System32\drivers\etc\hosts`.
- add the line `127.0.0.1 cosc-360-project.local`
- Save the file
- If it doesn't work, make sure you are editing the file as an admin. VS Code may prompt you to do this, otherwise I think you can open Notepad as admin.

#### On MacOS
You have to do essentially the same thing, but via the command line. See 2:25 of the video linked above.

### 1.3 The point
Now, you should be able to see access our website at http://cosc-360-project.test in your browser (as long as your Apache server is running).

## Part 2 - Initialize Database

### 2.1 start MySQL
- start MySQL in your XAMPP dashboard

### 2.2 Open the MySQL admin dashboard
- Go to [localhost/phpmyadmin](http://localhost/phpmyadmin/)

### 2.3 Import our database
- Click on `Server: 127.0.0.1` at the top of the page, then go to the `Import` tab
- Click `choose file` and select our database schema, which can be found at:
```
cosc-360-project/code/db_config/schema.sql
```

## Part 3 - Access the website
Not all parts of the website are available to non-logged in users.
- You can log in as any of the users added by the schema using the password `123abcA.`
- Log in as `sammie@example.com` if you want to see the admin view of things
- you can also create a new account yourself.