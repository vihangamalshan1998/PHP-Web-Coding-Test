For this project I used some components which are created by self in previous projects.

1.	Clone the repository using this link: https://github.com/vihangamalshan1998/PHP-Web-Coding-Test.git
2.	Make a copy of the .env.example file and rename it to .env. Fill in the required database information.
3.	Open a terminal and run the following commands: 
    1.	composer install 
    2.	npm install 
    3.	php artisan key:generate 
    4.	php artisan migrate:refresh --seed 
    5.	npm run build 
    6.	php artisan storage:link
4.	To run the project, execute the command php artisan serve in the terminal.
5.	In another terminal, run the queue using php artisan queue:work. This is important for receiving emails.
6.	To view the emails, go to https://mailtrap.io/ and log in using the email and password provided below: a. Email: nawakaya1111@gmail.com b. Password: nawakaya1234
7.	Once logged in, go to the email testing tab and select "My Inbox" to view the received mails.

Note: Mailtrap was used for testing mails because there was no mail server available to send emails.

