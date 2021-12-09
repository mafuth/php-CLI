<!-- badge -->

[![Contributors](https://img.shields.io/badge/Contributors-93b023?style=for-the-badge&logo=Contributors&logoColor=white)](https://github.com/mafuth/php-CLI/contributors)
[![Forks](https://img.shields.io/badge/Forks-93b023?style=for-the-badge&logo=Forks&logoColor=white)](https://github.com/mafuth/php-CLI/fork)
[![Stargazers](https://img.shields.io/badge/Stars-93b023?style=for-the-badge&logo=Stars&logoColor=white)](https://github.com/mafuth/php-CLI/)
[![Issues](https://img.shields.io/badge/Issues-FFA500?style=for-the-badge&logo=Issues&logoColor=white)](https://github.com/mafuth/php-CLI/issues)

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <h1 align="center">Simple PHP Comand Line Interface</h1>

  <p align="center">
    This project requires <b>php, composer and mysql database</b>
  </p>
</div>

<!-- GETTING STARTED -->
# Installation

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
   php cli --config
   ```
4. test connection to database
   ```sh
   php cli test data-base-connection
   ```
5. Start a local server
   ```sh
   php cli --serve
   ```

<!-- USAGE EXAMPLES -->
# Usage

### create command

Create a database table (replace '-- your table name --' with any name of your choice)
   ```sh
   php cli create table -- your table name --
   ```
Create a handler for post request (replace '-- your handler name --' with any name of your choice)
   ```sh
   php cli create handler -- your handler name --
   ```
Create a ajax request handler for all xml requests (replace '-- your handler name --' with any name of your choice)
   ```sh
   php cli create ajax -- your handler name --
   ```
Create a new run command (replace '-- your comand name --' with any name of your choice)
   ```sh
   php cli create run-comand -- your comand name --
   ```

### Data base tables command

Drop all tables and delete create function files
   ```sh
   php cli drop-tables
   ```
or use
   ```sh
   php cli drop-table -- your table name --
   ```
   
if want edit a table layout just edit the table lay out file at (database/create) directory and run the comand below
   ```sh
   php cli recreate-tables
   ```
or use
   ```sh
   php cli recreate-table -- your table name --
   ```
   

   
### run command
This command is used to run scripts created using (php cli create run-comand -- your comand name -- )
   ```sh
   php cli run -- your comand name --
   ```
   
   
<!-- Functions EXAMPLES -->
# Other functions

## DATABASE

insert to table
   ```php
   insert_to_table('table name', 'values array()',$conn);
   ```
select from table
   ```php
   select_from_table('table name',$conn);
   ```
update from table
   ```php
   update_table('table name','set colum','set value','where' ,'where equals to value',$conn);
   ```
delete from table
   ```php
   delete_from_table('table name','where' ,'where equals to value',$conn);
   ```
   

<!-- CONTRIBUTING -->
# Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!
