# Members
Ethan Sourn
Kyaw Han
Ryan Ritchie

# Bookstore

This is the Bookstore php & mysql website for Database 2 Class.
Below are the list of folders in the bookstore directory and description for them.

## How to start
Downlad XAMPP

    Enable Apache and MySQL modules

    The parent folder is bookstore, and once the xampp server is started, please go to

    http://localhost/bookstore/


## Admin
Folder for Admin functionalities.  
    - admin.php --> base path for the admin functionalities  
    - authors.php --> Admin functions to authors can be found here.  
    - books.php --> Admin functions to books can be found here.  
    - delete.php --> Admin functions to all delete can be found here.  
    - discounts.php --> Admin functions to all discounts can be found here.  
    - orders.php --> Admin functions to all orders can be found here.  
    - publishers.php --> Admin functions to all publishers can be found here.  
    - shipping.php --> Admin functions to all shipping can be found here.  
    - update_price.php --> Admin functions to update the price of shipping can be found here.  
    - users.php --> Admin functions to users can be found here.  

## Author
Folder for Author functionalities.  
    - author-validation.php --> When user sign in, it checks if the user is author.  
    - author.php --> This is where user will be redirected to if user is an author.  

## Books
Folder for Book functionalities.  
    - add-book.php --> publisher/ admin can add book using this php file.  
    - comments.php --> users can view the comments on the books.  
    - display-books.php --> this php file is used to display list of books in index.php  
    - edit-boo.php --> publishers/ admin can edit book using this file.  
    - search-book.php --> php file for search functionalities.  
    - search-results.php --> php file for search results.  

## Config
Folder for database configurations.  
    - db_connection.php --> connection for all the database operations.  

## Database
Folder for SQL files.  
    - DB2.sql --> Database, Table Creations, Initial data insertions all goes here.  

## functions
Folder for utlities functions.  
    - functions.php --> all utlities functions goes here.  

## login
Folder for login functions.  
    - admin.php --> admin auth login file  
    - log-in-publishers.php --> publishers auth login file  
    - log-in-users.php --> users auth login file  

## Orders
Folder for order functions.  
    - comment_rating.php --> users can add comment, rating through this file.  
    - order_history.php --> display the ordre history.  
    - reorder.php --> ability to reorder from the order history.  
    - shopping_cart.php --> display the shopping cart and do checkout operations.  

## Premium
Folder for Premium functions.  
    - billingaddress-premium-signup.php --> add billing address  
    - card-payment-premium-signup.php --> add payment method  
    - premium-success.php --> upgrade to premium user.  
    - users-premium.php --> home for premium users.  

## publisher
Folder for publisher functions.  
    - publisher.php --> publishers dashboard file  

## signup
Folder for signup functions.  
    - publishers-signup.php --> new publishers can sign up in this file.  
    - users-signup.php --> new user can sign up in this file.  

## templates
Folder for template files.  
    - header.php --> Headers and all functions used in every file is stored here.  
    - footer.php --> footer where js code can go here.  

## users
Folder for user functionalities.  
    - billingaddress-signup.php --> user can signup billing address  
    - car-payment-signup.php --> user can signup payment method  
    - user-payment-info.php --> dashboard for user payment method and shipping address.  
    - users.php --> dashboard for non author users.  

## varaibles
Folder for general variables.  
    - variables.php --> php file for all general and global variables.  


# General Testing Info

## Admin
    username: admin
    password: admin

## User
    username: user1
    password: pass

## Publisher
    username: publisher1@gmail.com  
    password: password


# Contributors & Parts

## Ethan Sourn
    - Users, Authors, Discounts

## Kyaw Han
    - Books, Publishers, Admin

## Ryan Ritchie
    - Cart, Orders, Shipping
