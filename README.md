<div id="top"></div>


<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



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
