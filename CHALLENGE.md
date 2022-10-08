# message-board
The bread-and-butter of Storyhunter is the ability of freelancers and publishers to communicate with each other. As such, we'd like to explore how you would structure a simple message exchange API. This test is designed to verify that:
* You have proficiency with our tech stack
* You are able to architect a working system from a small design brief
* You are able to model relationships

## Requirements
1. We will be building the api interface and data model for a simple message board.

2. You should write your API in Laravel PHP. Feel free to use any officially supported packages. Your application and database should be able to run locally on a Mac or Linux system using Sail.

3. Your APIs should follow a RESTful pattern. Responses should be sent in a well structured format of your choice.

4. Please create one additional feature of your choosing.  This can be anything you think might be interesting or demonstrate your knowledge.

5. Sending a new Message on a Thread should queue a job to notify the other members of the Thread of new activity.
   1. This job should be delayed 1 minute
   2. Additional jobs queued within that 1 minute for the same Thread + User should be consolidated. In other words, a User should get at most one notification per Thread per minute.
   3. This job does not need to send an actual email. For the purposes of this project, it can simply log or output a notice to console.

## Models

### User
* id (int)
* email (string)
* full name (string)
* password (hashed string)
* bio (string)

### Thread
* id (int)
* title (string)

### Message
* id (int)
* user_id (int)
* thread_id (int)
* body (string)

## Endpoints

Endpoint parameters and return values are defined. You may decide whether parameters should be passed as part of the URL (eg `/users/{userId}`), as a query parameter, or as value in the request body. This does not need to be strictly RESTful, but you should be thoughtful in your decisions.

### Create User (un-authenticated)
> * Accepts an email, password, full name, a short biography
> * Returns an authentication token

### Login (un-authenticated)
> * Accepts email and password
> * Returns an authentication token

### Get User (authenticated)
> * Accepts User id
> * Returns User model
>   * User model password should be omitted
>   * User model email should be omitted if User is not the authenticated User 

### Create Thread (authenticated)
> Any authenticated user can create a new Thread
> * Accepts a title
> * Returns a Thread model

### Get User Threads (authenticated)
> Returns all Threads that a given User has participated in
> * Accepts a User id
> * Returns a collection of Thread models

### Create Thread Message (authenticated)
> Adds a Message to a given Thread. Authenticated users can add a Message to any existing Thread
> * Accepts target Thread id, sending User id, Message body string
> * Returns a Message model

### Edit Thread Message (authenticated)
> A User may edit the body of a message they have sent for up to 5 minutes after creation
> Accepts target Message id, new Message body string
> Returns 200 status

### Get Thread Messages (authenticated)
> Returns all Messages associated with a given Thread
> * Accepts target Thread id
> * Returns a collection of Message models

### Search User Messages (authenticated)
> Returns all Messages that a given User has sent, that match a provided search term
> * Accepts target Thread id, search term string
> * Returns a collection of Message models
> * NOTE - You can decide whether to search strictly or loosely. Please document the behavior.

## Submitting your work
* When you have finished the assignment, create a github repository and share it with @jknight12882 and @soundsgoodsofar.
* All submissions must include a `README.md` explaining how to install and run your application.
* The `README.md` should contain notes about any design choices made that may not be immediately understood from reading the code
* Code should be well commented
* Your work should be "production ready"