# news-collector
Symfony application that collects news and displays them on a single website, along with sources and images.

<h2>Scraping</h2>
To start collecting & persisting articles to a database you run: <br>
<code>php bin/console scrape:source source</code>
Where the <code>source</code> argument is the SF command that calls the scraper. <br>

<h2>Environment</h2>
The application runs on Nginx and MySQL - on Docker, docker-compose in included in the repository
