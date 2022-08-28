<?php
$secretsDefault = 'on: push 
name: 🚀 Deploying on github update
jobs:
  web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    steps:
    - name: 🚚 Geting latest code from github
      uses: actions/checkout@v2
    
    - name: 📂 Syncing files on server
      uses: SamKirkland/FTP-Deploy-Action@4.3.0
      with:
        server: ${{ secrets.FTP_SERVER }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}';
       
$secrets = 'on: push 
name: 🚀 Deploying on github update
jobs:
  web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    steps:
    - name: 🚚 Geting latest code from github
      uses: actions/checkout@v2
    
    - name: 📂 Syncing files on server
      uses: SamKirkland/FTP-Deploy-Action@4.3.0
      with:
        server: ${{ secrets.FTP_SERVER }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}
        server-dir: ${{ secrets.FTP_DIR }}';

$customDefault = 'on: push 
name: 🚀 Deploying on github update
jobs:
    web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    steps:
    - name: 🚚 Geting latest code from github
        uses: actions/checkout@v2
    
    - name: 📂 Syncing files on server
        uses: SamKirkland/FTP-Deploy-Action@4.3.0
        with:
        server: "'.$server.'"
        username: "'.$user.'"
        password: "'.$password.'"';

$custom = 'on: push 
name: 🚀 Deploying on github update
jobs:
    web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    steps:
    - name: 🚚 Geting latest code from github
        uses: actions/checkout@v2
    
    - name: 📂 Syncing files on server
        uses: SamKirkland/FTP-Deploy-Action@4.3.0
        with:
        server: "'.$server.'"
        username: "'.$user.'"
        password: "'.$password.'"
        server-dir: "'.$dir.'"';
