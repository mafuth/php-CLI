<!-- badge -->

[![Contributors][contributors-shield]][https://github.com/mafuth/php-CLI/contributors]
[![Forks][forks-shield]][https://github.com/mafuth/php-CLI/fork]
[![Stargazers][stars-shield]][https://github.com/mafuth/php-CLI/]
[![Issues][issues-shield]][https://github.com/mafuth/php-CLI/issues]

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
