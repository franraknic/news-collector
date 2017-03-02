# news-collector
A web application written in PHP using Symfony3, made during the summer internship.<br><br>
Documentation (in Croatian):<br>
<a href="https://drive.google.com/open?id=1V4x1Dn5ER0Z3JrCLkPYvQUGHyEa9HGTmLihFMvv7P3s">Functional specifications</a><br>
<a href="https://drive.google.com/open?id=14T9rJMVGdSCy3yUPLw4VotVcOUv8VuZMZV9_y8WPNUc">Technical specifications</a><br>

<h2>Scraping</h2>
To start collecting & persisting articles to a database you run: <br>
<code>php bin/console scrape:source source</code><br>
Where the <code>source</code> argument is the SF command that calls the scraper. <br>

<h2>Environment</h2>
The application runs on Nginx and MySQL - on Docker, docker-compose in included in the repository
