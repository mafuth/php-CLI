<?php
$secretsFTPDefault = 'on: push 
name: 🚀 Deploying on github update
jobs:
  web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

    steps:
    - name: 🚚 Geting latest code from github and installing dependencies
      uses: actions/checkout@v2
    - uses: "shivammathur/setup-php@v2"
      with:
        php-version: "${{ matrix.php }}"
    - uses: "ramsey/composer-install@v2"
      with:
        dependency-versions: "${{ matrix.dependencies }}"
        composer-options: "${{ matrix.composer-options }}"
    
    - name: 📂 Syncing files on server
      uses: SamKirkland/FTP-Deploy-Action@4.3.0
      with:
        server: ${{ secrets.FTP_SERVER }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}';
       
$secretsFTP = 'on: push 
name: 🚀 Deploying on github update
jobs:
  web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

    steps:
    - name: 🚚 Geting latest code from github and installing dependencies
      uses: actions/checkout@v2
    - uses: "shivammathur/setup-php@v2"
      with:
        php-version: "${{ matrix.php }}"
    - uses: "ramsey/composer-install@v2"
      with:
        dependency-versions: "${{ matrix.dependencies }}"
        composer-options: "${{ matrix.composer-options }}"
    
    - name: 📂 Syncing files on server
      uses: SamKirkland/FTP-Deploy-Action@4.3.0
      with:
        server: ${{ secrets.FTP_SERVER }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}
        server-dir: ${{ secrets.FTP_DIR }}';

$customFTPDefault = 'on: push 
name: 🚀 Deploying on github update
jobs:
    web-deploy:
      name: 🎉 Deploying '.$config['appname'].'
      runs-on: ubuntu-latest
      strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

      steps:
      - name: 🚚 Geting latest code from github and installing dependencies
        uses: actions/checkout@v2
      - uses: "shivammathur/setup-php@v2"
        with:
          php-version: "${{ matrix.php }}"
      - uses: "ramsey/composer-install@v2"
        with:
          dependency-versions: "${{ matrix.dependencies }}"
          composer-options: "${{ matrix.composer-options }}"
      
      - name: 📂 Syncing files on server
        uses: SamKirkland/FTP-Deploy-Action@4.3.0
        with:
          server: "'.$server.'"
          username: "'.$user.'"
          password: "'.$password.'"';

$customFTP = 'on: push 
name: 🚀 Deploying on github update
jobs:
    web-deploy:
      name: 🎉 Deploying '.$config['appname'].'
      runs-on: ubuntu-latest
      strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

      steps:
      - name: 🚚 Geting latest code from github and installing dependencies
        uses: actions/checkout@v2
      - uses: "shivammathur/setup-php@v2"
        with:
          php-version: "${{ matrix.php }}"
      - uses: "ramsey/composer-install@v2"
        with:
          dependency-versions: "${{ matrix.dependencies }}"
          composer-options: "${{ matrix.composer-options }}"
      
      - name: 📂 Syncing files on server
        uses: SamKirkland/FTP-Deploy-Action@4.3.0
        with:
          server: "'.$server.'"
          username: "'.$user.'"
          password: "'.$password.'"
          server-dir: "'.$dir.'"';


$secretsSFTPDefault = 'on: push 
name: 🚀 Deploying on github update
jobs:
  web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

    steps:
    - name: 🚚 Geting latest code from github and installing dependencies
      uses: actions/checkout@v2
    - uses: "shivammathur/setup-php@v2"
      with:
        php-version: "${{ matrix.php }}"
    - uses: "ramsey/composer-install@v2"
      with:
        dependency-versions: "${{ matrix.dependencies }}"
        composer-options: "${{ matrix.composer-options }}"
    
    - name: 📂 Syncing files on server
      uses: wlixcc/SFTP-Deploy-Action@v1.2.4
      with:
        server: ${{ secrets.FTP_SERVER }}
        username: ${{ secrets.FTP_USERNAME }}
        password: ${{ secrets.FTP_PASSWORD }}
        port: ${{ secrets.SFTP_PORT }}
        sftp_only: true';
        
$secretSFTP = 'on: push 
name: 🚀 Deploying on github update
jobs:
  web-deploy:
    name: 🎉 Deploying '.$config['appname'].'
    runs-on: ubuntu-latest
    strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

    steps:
    - name: 🚚 Geting latest code from github and installing dependencies
      uses: actions/checkout@v2
    - uses: "shivammathur/setup-php@v2"
      with:
        php-version: "${{ matrix.php }}"
    - uses: "ramsey/composer-install@v2"
      with:
        dependency-versions: "${{ matrix.dependencies }}"
        composer-options: "${{ matrix.composer-options }}"
    
    - name: 📂 Syncing files on server
      uses: wlixcc/SFTP-Deploy-Action@v1.2.4
      with:
        server: ${{ secrets.SFTP_SERVER }}
        username: ${{ secrets.SFTP_USERNAME }}
        password: ${{ secrets.SFTP_PASSWORD }}
        port: ${{ secrets.SFTP_PORT }}
        remote_path: ${{ secrets.SFTP_DIR }}
        sftp_only: true';

$customSFTPefault = 'on: push 
name: 🚀 Deploying on github update
jobs:
    web-deploy:
      name: 🎉 Deploying '.$config['appname'].'
      runs-on: ubuntu-latest
      strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

      steps:
      - name: 🚚 Geting latest code from github and installing dependencies
        uses: actions/checkout@v2
      - uses: "shivammathur/setup-php@v2"
        with:
          php-version: "${{ matrix.php }}"
      - uses: "ramsey/composer-install@v2"
        with:
          dependency-versions: "${{ matrix.dependencies }}"
          composer-options: "${{ matrix.composer-options }}"
      
      - name: 📂 Syncing files on server
        uses: wlixcc/SFTP-Deploy-Action@v1.2.4
        with:
          server: "'.$server.'"
          username: "'.$user.'"
          password: "'.$password.'"
          port: "'.$port.'"
          sftp_only: true';

$customSFTP = 'on: push 
name: 🚀 Deploying on github update
jobs:
    web-deploy:
      name: 🎉 Deploying '.$config['appname'].'
      runs-on: ubuntu-latest
      strategy:
      matrix:
        php:
          - "7.4"
          - "8.0"
          - "8.1"
        dependencies:
          - "lowest"
          - "highest"
        include:
          - php-version: "8.2"
            composer-options: "--ignore-platform-reqs"

      steps:
      - name: 🚚 Geting latest code from github and installing dependencies
        uses: actions/checkout@v2
      - uses: "shivammathur/setup-php@v2"
        with:
          php-version: "${{ matrix.php }}"
      - uses: "ramsey/composer-install@v2"
        with:
          dependency-versions: "${{ matrix.dependencies }}"
          composer-options: "${{ matrix.composer-options }}"
      
      - name: 📂 Syncing files on server
        uses: wlixcc/SFTP-Deploy-Action@v1.2.4
        with:
          server: "'.$server.'"
          username: "'.$user.'"
          password: "'.$password.'"
          port: "'.$port.'"
          remote_path: "'.$dir.'"
          sftp_only: true';
