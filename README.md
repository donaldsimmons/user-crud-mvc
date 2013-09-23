user-crud-mvc
=============

Summary

This application is small User Authentication system built on an MVC architecture. It
allows for all 4 of the CRUD operations on a table of users. Users can signup, see
profile information, edit their specific information, and finally delete their
account, all from this one interface.

The project is built on MVC principles, though it is not a full-fledged MVC 
application. All redirection and behavior is executed in a controller, and the data
layer for the application is sequestered in its own model; however, the View layer 
consists of HTML templates, while the actual functionality is included in the 
controller class.

Code & Technologies

Several prominent web technologies are leveraged in this project. All code is
hand-coded, and the project doesn't utilize any third-party frameworks, modules,
or code.

The site is built on PHP and all behavior is handled by this back-end programming
language. Database interfacing is built using the PDO object in PHP, and communicate
MySQL's structured queries. The application's views are built using hand-coded
HTML5 and CSS3.