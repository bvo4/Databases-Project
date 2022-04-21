Google Doc Link: https://docs.google.com/document/d/157CQeWFcTgx7Zm0NcxamOpN-j6kFo0EnaryiuE7A0A0/edit?usp=sharing

# Deployment Instructions
## Prerequisites
You will need the following technologies installed on your system, or quickly look up a guide to install them on your system:
### Terminal/Console
This part is heavily dependent on your operating system, but IDEs such as [Visual Studio Code](https://code.visualstudio.com/download) allow you to access the terminal while you are working, and run commands on the fly.
### GitHub
You will need to have [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) installed on your machine and create a GitHub account that you will be able to log into.
### Python
Ensure that you have [Python](https://www.python.org/downloads/) version 3.6.9 installed on your machine. Check the version with the following command:
```
python --version
```
### Node.js
Ensure that you have [Node.js](https://nodejs.org/en/download/) version 12.10.0 installed on your machine. Check the version with the following command:
```
npm -v
```

## Installation
### Clone the Repository
The first step is to clone the repository from [GitHub](https://github.com/MilsonCodes/CSC4330-project). You can do this manually from the link by downloading the files or you can run the following command:
```
https://github.com/bvo4/Databases-Project.git
```
### Install Client Dependencies
Next you will need to install the libraries used on the frontend. To do this, navigate to the client folder using:
```
cd CSC6093-project/client
```
Then, install the required files by running the command:
```
npm i
```

## Running the Website
### Client
After the installations are complete, run the following command to launch the frontend:
```
npm start
```
This will allow you to see the website at http://localhost:3000/, however this will not work properly until the backend is started in the following steps.
#### Virtual Environment
To start the virtual environment, you will need to create a new terminal in order to leave the client running. This is usually done through CTRL+SHIFT+t or some visual tool. Once you have a second terminal open, navigate to the project's root directory by typing the command:
```
cd ../
```
Then you will need to start the virtual environment using the following command (this command may vary across operating systems):
```
source backend/bin/activate
```
### API
The final step is to start the backend. This will allow the client to access the database. Start the API with the following command:
```
python manage.py runserver
```

## Viewing the Site
To view the site, navigate to http://localhost:3000/. You can create a new account or email me for an administrator account.
