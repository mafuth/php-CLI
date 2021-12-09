<!-- badge -->
[![travis status](https://img.shields.io/travis/tanhauhau/generator-badge.svg)](https://travis-ci.org/tanhauhau/generator-badge)
[![appveyor status](https://img.shields.io/travis/tanhauhau/generator-badge.svg)](https://ci.appveyor.com/project/tanhauhau/generator-badge)
[![wercker status](https://app.wercker.com/status/15d1bfe55ec05c73b82704c4912f4323/s)](https://app.wercker.com/project/bykey/15d1bfe55ec05c73b82704c4912f4323)
[![wercker status](https://app.wercker.com/status/15d1bfe55ec05c73b82704c4912f4323/m)](https://app.wercker.com/project/bykey/15d1bfe55ec05c73b82704c4912f4323)  
[![npm version](https://img.shields.io/npm/v/generator-badge.svg)](https://www.npmjs.com/package/generator-badge)
[![npm license](https://img.shields.io/npm/l/generator-badge.svg)](https://www.npmjs.com/package/generator-badge)
[![npm download](https://img.shields.io/npm/dm/generator-badge.svg)](https://www.npmjs.com/package/generator-badge)
[![npm download](https://img.shields.io/npm/dt/generator-badge.svg)](https://www.npmjs.com/package/generator-badge)
[![david dependency](https://img.shields.io/david/tanhauhau/generator-badge.svg)]()
[![david dev-dependency](https://img.shields.io/david/dev/tanhauhau/generator-badge.svg)]()  
[![GitHub followers](https://img.shields.io/github/followers/tanhauhau.svg?style=social&label=Follow)](https://github.com/tanhauhau/generator-badge)
[![GitHub forks](https://img.shields.io/github/forks/tanhauhau/generator-badge.svg?style=social&label=Fork)](https://github.com/tanhauhau/generator-badge/fork)
[![GitHub stars](https://img.shields.io/github/stars/tanhauhau/generator-badge.svg?style=social&label=Star)](https://github.com/tanhauhau/generator-badge)
[![GitHub watchers](https://img.shields.io/github/watchers/tanhauhau/generator-badge.svg?style=social&label=Watch)](https://github.com/tanhauhau/generator-badge)
[![GitHub issues](https://img.shields.io/github/issues/tanhauhau/generator-badge.svg?style=social)](https://github.com/tanhauhau/generator-badge/issues)
<!-- endbadge -->


<!-- PROJECT LOGO -->
<br />
<div align="center">
  <h3 align="center">Simple PHP Comand Line Interface</h3>

  <p align="center">
    This project requires php, composer and mysql database
  </p>
</div>

<!-- GETTING STARTED -->
### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/mafuth/php-CLI.git
   cd php-CLI
   ```
2. Check for installation
   ```sh
   php cli --v
   ```
3. Configure the installation
   ```sh
   php cli --configure
   ```
4. test connection to database
   ```js
   php cli test data-base-connection
   ```
5. Start a local server
   ```js
   php cli --serve
   ```

<!-- USAGE EXAMPLES -->
### Usage

# create command

Create a database table (replace '-- your table name --' with any name of your choice)
   ```js
   php cli create table -- your table name --
   ```
Create a handler for post request (replace '-- your handler name --' with any name of your choice)
   ```js
   php cli create handler -- your handler name --
   ```
Create a ajax request handler for all xml requests (replace '-- your handler name --' with any name of your choice)
   ```js
   php cli create ajax -- your handler name --
   ```
Create a new run command (replace '-- your comand name --' with any name of your choice)
   ```js
   php cli create run-comand -- your comand name --
   ```

# Data base tables command

Drop all tables and delete create function files
   ```js
   php cli drop-tables
   ```
if want edit a table layout just edit the table lay out file at (database/create) directory and run the comand below
   ```js
   php cli recreate-tables
   ```
   
# run command
This command is used to run scripts created using (php cli create run-comand -- your comand name -- )
   ```js
   php cli run -- your comand name --
   ```


<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request
