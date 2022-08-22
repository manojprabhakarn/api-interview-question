# API Task (SNA)

## Setup
**1.Apache installation & config**

    Apache is an open source web server that’s available for Linux servers free of charge.
In this tutorial we’ll be going through the steps of setting up an Apache server.

    -https://ubuntu.com/tutorials/install-and-configure-apache#1-overview

**2.PHP installation**

Debian Install Example with Apache 2

    'apt install php-common libapache2-mod-php php-cli'


### git clone.

**clone the code from the repository**

    git clone https://git.selfmade.ninja/manoj1/apitask.git

### setup .env file


Right outside the document root, create a file called env.json and keep the contents of the file similar to the following.

```
{
	"database": "apis",
	"username": "root",
	"password": "password",
	"server": "localhost",
}
```
## Virtual Host Apache Configuration:

```
<VirtualHost *:80>
    ServerAdmin hello@sibidharan.me       
    DocumentRoot "/var/www/api-development-course-apr-2021"
    ServerName api1.selfmade.ninja 

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory "/var/www/api-development-course-apr-2021">
            Options Indexes FollowSymLinks ExecCGI Includes
            AllowOverride All
            Require all granted
    </Directory>
</VirtualHost>
```

## How to Download and Install POSTMAN

Being an Open Source tool, Postman can be easily downloaded. Here are the steps to install:

**Download Postman**
Go to https://www.postman.com/downloads/ and choose your desired platform among Mac, Windows or Linux. Click Download.

Reference : https://www.guru99.com/postman-tutorial.html

**Working with GET AND POST Requests**

Get requests are used to retrieve information from the given URL. There will be no changes done to the endpoint.

We will use the following URL for all examples in this Postman tutorial

https://sample.example.com/users		

In the workspace

    1.Set your HTTP request to GET.
    2.In the request URL field, input link
    3.Click Send
    4.You will see 200 OK Message

# Optional
## How to use POSTMAN for Performance Setting
    1.Set your HTTP Request to POST or GET
    2.Enter the url
    3.Click Send
    4.you will see 200 ok message
    5.Select Test tab and Perform your testing

## How to Perform performance and load test using (JMeter)
1. Add Thread Group
    - Start JMeter
    - Select Test Plan on the tree
    - Add Thread Group

2. Adding JMeter elements
    - This element can be added by right-clicking on the Thread Group and selecting: Add -> Config Element -> HTTP Request

3. Adding Graph Result
    - JMeter can show the test result in Graph format.

    - Right click Test Plan, Add -> Listener -> Graph Results

4. Add another Listener Tree-result
    - Press the Run button (Ctrl + R) on the Toolbar to start the software testing process. You will see the test result display on Graph in the real time.
```
    Black: The total number of current samples sent.
    Blue: The current average of all samples sent.
    Red: The current standard deviation.
    Green: Throughput rate that represents the number of requests per minute the server handled
```