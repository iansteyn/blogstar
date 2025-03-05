# XAMPP Set-up
See slides/consult friends for how to actually install XAMPP. These steps are set-up for the project specifically; they allow us to run our project code on a local Apache server without moving the whole repository to `htdocs/`.

I know for sure these steps work for Windows. I have added some notes for Mac too, but this video seems to be a good guide: [How to Configure Virtual Hosts in XAMPP on a Mac](https://www.youtube.com/watch?v=zRIa8-MF6pw).

## 1. Configure Virtual Hosts

Open your `httpd-vhosts.conf` file in XAMPP.
- On Windows: most likely `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
- on MacOS: I think `/Applications/XAMPP/etc/extra/httpd-vhosts.conf`?

Add the following code to this file:
```
# Main host
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "C:/xampp/htdocs" #or whatever the quivalent path is on your computer
</VirtualHost>

# COSC 360 Project host
<VirtualHost *:80>
    DocumentRoot "<insert-absolute-path>/cosc-360-project/code"
    ServerName cosc-360-project.local
    <Directory "<insert-absolute-path>/cosc-360-project/code">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## 2. Edit Your hosts File:

### On Windows
- Open the file `C:\Windows\System32\drivers\etc\hosts`.
- add the line `127.0.0.1 cosc-360-project.local`
- Save the file
- If it doesn't work, make sure you are editing the file as an admin. VS Code may prompt you to do this, otherwise I think you can open Notepad as admin.

### On MacOS
You have to do essentially the same thing, but via the command line. See 2:25 of the video linked above.

## 3. Make sure it works
- Restart the Apache server in your XAMPP Control Panel.
- Now, you should be able to access your project in your browser by typing http://cosc-360-project.local.
- You should also still be able to access files in your `htdocs/` normally (you want this to work because we will put lab files in htdocs)
  - Test this by accessing http://localhost/ - If the xampp dashboard shows up, you're all set.