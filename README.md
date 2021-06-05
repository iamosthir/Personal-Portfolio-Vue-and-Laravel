<h1 align="center">Personal Portfolio And Blog Web site</h1>
<p>This web application is made with Vue JS and Laravel. Bellow down you will get learn about setting up this on your machine</p>
<br>
<h4><b>Software Requirements</b></h4>
<ul>
    <li>Xampp With PHP 7.3</li>
    <li><a href="https://getcomposer.org/" target="_blank">Composer</a></li>
</ul>
<br>
<h4><b>Installation</b></h4>
<ol>
    <li>Download the all the files</li>
    <li>Extract and open the project root folder</li>
    <li>Start Xampp Server with apache and MySQL</li>
    <li>Now create an empty database from php my admin</li>
    <li>From project root folder copy the <b>.env.example</b> file rename the file with <strong>.env</strong> and inside that .env file, edit the variable <b>DB_DATABASE</b> with your created empty database name.
    Set DB_USERNAME and DB_PASSWORD accroding to your xampp user credentials</li>
    <li>Now again go to project folder and open a shell window there. You can use Command Prompt, or any other shell command tool</li>
    <li>First Run  'composer install' command</li>
    <li>now run "php artisan key:generate" to generate an app key</li>
    <li>Now type <b>php artisan multiauth:install</b> and hit enter. This will install admin authentication</li>
    <li>Then type <b>php artisan migrate</b> and hit enter</li>
    <li>Then type <b>php artisan db:seed</b> and hit enter</li>
    <li>Setup is now complete</li>
    <li>Just type <b>php artisan serve</b> in shell window and hit enter. A new laravel developmnet server will start on localhost:8000 </li>
    <li>Now your are ready to deploy this site on your live server or modify it from your local machine</li>
</ol>
<hr>
<p align="center">Thanks for downloading this project</p>
