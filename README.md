# PHP-Random-Google-Photo-Widget
Simple Random Image Display From Predefined Search Terms. No API
<p>
This is a simple PHP script that searches Google images for the pre-defined term(s) and displays a random image at every load. I'm working on this for a widget to my social network site. I wanted something quick and simple that does not depend on any external services or API.
<p>
There are two versions. The norrmal version and the framed version. Simply open up the file and modify the settings to suit your needs such as changing the search term to better match your website theme. This is a nice widget that can be intergrated in web portals, forums, plugins etc,,,<p>
Note that this code uses regular expressions to extract the image URLs and alt tags, which can be unreliable and may break if Google Images changes its HTML structure. Ideally, you should use a more robust solution such as a web scraping library or an API to retrieve images from Google. I wanted to try this way and it works for now. <p>
<li>Tested on PHP 8.20</li>
