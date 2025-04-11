# Remote Server Setup

It's very possible that these instructions won't be needed for someone else, but I'm writing it here for my own benefit and in case I need to tell someone how to do it.

## Step 1: Get VPN access
- download: [UBCO Software downloads - Cisco Secure Client (MyVPN Service)](https://e5.onthehub.com/WebStore/OfferingDetails.aspx?o=4f06cf70-45e9-ef11-8170-000d3af41938&ws=4f259259-10e4-de11-a13b-0030487d8897&vsro=8)
- login with:
  - username: `<your-cwl>@app` (if you use Duo Mobile for 2 factor authentication, otherwise the @ is something different)
  - password: `<your-cwl-password>`

## Step 2: connect to linux server with SSH

In a terminal:
```
ssh <my-cwl>@cosc360.ok.ubc.ca
```

The Canvas instructions say that Windows users need to download third-party software to connect to the Linux server with SSH. I am pretty sure this is super outdated info; most Windows installations seem to come with an SSH CLI installed by default now. I was able to just connect in my PowerShell terminal using the above command.