<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]
[![Twitter][twitter-shield]][twitter-url]

<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://gitlab.com/adam.blakey/Pollererer">
    <img src="https://gitlab.com/uploads/-/system/project/avatar/38570009/Screenshot_from_2022-08-13_22-24-50.png" alt="Logo" width="80" height="80">
  </a>

  <h1 align="center">Pollererer</h1>

  <p align="center">
    A simple music rehearsal absence logging system.
    <br />
    <br />
    <a href="https://gitlab.com/adam.blakey/Pollererer/-/issues">Report Bug</a>
    ·
    <a href="https://gitlab.com/adam.blakey/Pollererer/-/issues">Request Feature</a>
  </p>
</p>

<!-- TABLE OF CONTENTS -->
## Table of Contents

- [Table of Contents](#table-of-contents)
- [About The Project](#about-the-project)
	- [Built With](#built-with)
- [Documentation](#documentation)
- [Getting Started](#getting-started)
	- [Prerequisites](#prerequisites)
	- [Installation](#installation)
- [Main features and usage](#main-features-and-usage)
- [License](#license)
- [Contact](#contact)

<!-- ABOUT THE PROJECT -->
## About The Project

[![Pollererer Screenshot][product-screenshot]](https://gitlab.com/adam.blakey/Pollererer/)

This project was created for three main reasons:

1. To help me keep track of rehearsal absences for a local music group.
2. An excuse to use Tabler.io's amazing admin interface.
3. An opportunity to learn about the ingredients of a modern web application.

### Built With

These are the main pieces of software that this project uses.

* [Tabler](https://tabler.io)
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)

<!-- DOCUMENTATION -->
## Documentation

Ha! I wish there was documentation. This project is still in its infancy, and is for a very specific use case. If you think you'd benefit from this project, then feel free to get in touch.

<!-- GETTING STARTED -->
## Getting Started

To get a local instance of Pollererer running, you'll need to follow the following steps.

### Prerequisites

You'll need to install

* apache2
* php
* mysql (or equivalent)

```sh
apt install apache2 php mysql
```

### Installation

1. Clone the repo to your web server root.
2. Setup database; we suggest a username and database name of 'pollererer'.
3. Copy the sample config from test/sample_config.php to config.php
```sh
cp test/sample_config.php config.php
```
4. Appropriately edit the config.php file to match your environment, for example:
```PHP
<?php

$config = array(
	"base_url"        => "https://attendance.pollererer.com/",
	"home_url"        => "https://pollererer.com",
	"db_host"         => "localhost",
	"db_username"     => "mysql_user",
	"db_password"     => "strong_password123456789",
	"db_name"         => "mysql_database",
	"repeat_headings" => true,
	"software_name"   => "Pollererer Attendance",
	"smtp_host"       => "smtp.pollererer.com",
	"smtp_username"   => "attendance@pollererer.com",
	"smtp_password"   => "another_password123456789",
	"smtp_port"       => 465,
	"email_from"      => "attendance@pollererer.com",
	"email_pdf"       => array(1, 3),
	"admin_email"     => "admin@pollererer.com",
	"logo_url"        => "https://pollererer.com/uploads/logo.png",
	"group_name"      => "The Musical Pollererers",
	"maintenance_mode" => false // true: all pages/API/cron/emails stop with a 503
);

?>
```

<!-- USAGE EXAMPLES -->
## Main features and usage

You may use this project to:

* Ask members of your music group to login and input their availability for rehearsals and concerts.
* Email rehearsal organisers with seating plan and attendance list before a rehearsal starts.

<!-- LICENSE -->
## License

Distributed under the GNU GPLv3 License. See `LICENSE` for more information.

<!-- CONTACT -->
## Contact

Adam Blakey - [@amblakey](https://twitter.com/amblakey)

Project Link: [https://gitlab.com/adam.blakey/Pollererer](https://gitlab.com/adam.blakey/Pollererer)

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[license-shield]: https://img.shields.io/gitlab/license/adam.blakey/pollererer?style=flat-square
[license-url]: https://gitlab.com/adam.blakey/Pollererer/-/blob/master/LICENSE
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=flat-square&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/adammatthewblakey/
[twitter-url]: https://twitter.com/amblakey
[twitter-shield]: https://img.shields.io/twitter/follow/amblakey?style=flat-square

[product-screenshot]: screenshot.png
