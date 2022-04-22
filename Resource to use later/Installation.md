## Deployment
In order to run the current implementation of the server, first start the virtual environment, enter the command:
```
source backend/bin/activate
```
from the project root directory. Then, from the root of the frontend directory run:
```
npm i
npm start
```
This will start the client (frontend). Next, from the root of the Django project (containing the manage.py file), run the command:
```
python3 manage.py runserver
```
in order to start the API.
Navigate to http://localhost:3000/ to view the client and http://localhost:8000/ to view API endpoint.

## Getting Started

These instructions will provide the necessary guidance on how to install the following software to work on your projects. 

###### Note: The way both React and Node.js are installed might end up being different depending on the OS the programmer is using. 

## Prerequisites 

Before you can begin your projects, you will need to have Node.js and a package manager in your development environment.

#### Installing Node.js

To install Node.js, please do the following: 

* Download and install [Node.js](https://nodejs.org/en/) 
* Check the version you have installed by typing the following command in your terminal/console window.

```
node -v
```
or 

```
node --version
```

#### npm package manager

The npm package manager is needed in order to download and install npm packages, which you can learn more about [here](https://docs.npmjs.com/about-npm/index.html). It should be included with the installation of node.  
* To make sure that you have a npm client installed on your computer, type the following command in your terminal/console window.
```
npm -v 
```
#### Cloning/Downloading a Repository
* Be sure to download and install git [here](https://git-scm.com/downloads).
* To clone/download a repository, please type the following command in you terminal/console: 

###### Note: Before you download this, you will need to make that you have git installed by typing *git --version* in your terminal/console.

```
git clone https://github.com/MilsonCodes/CSC3380_Project.git
```
###### Note: Mac uses / and Windows uses \ when accessing directories through the terminal/console

After cloning the git repo, navigate to the project directory and run the node installation command.
```
cd folder-name
```
```
npm i 
```
or
```
npm install
```

Next, you will want to see the site as you are working on it. To do this, navigate to the src folder and run the developement command
```
cd src/
npm start
```
Now you can navigate to http://localhost:3000/ to see the website. This will update automatically when you save changes to a file.

#### Installing Django 

To install Django follow these steps: 
Follow instructions here to donwload [Python3](https://www.python.org/downloads/)

Then you will need to install pip, a python installation manager, in order to assist with package installation. [PIP Install] (https://pip.pypa.io/en/stable/installing/)

The last step is to install Django using the following command:
```
python -m pip install Django
```
##### Note: All of these commands can be run a virtual environment to assist with version control.

## Git commands
#### IMPORTANT: Make sure to work from a seperate branch, NEVER commit directly to Master.
To pull the most recent changes for a branch:
```
git pull origin branch-name
```
To create a new branch:
```
git checkout -b branch-name
```
To switch to a different branch:
```
git checkout branch-name
```
To push your changes you will need to use three seperate commands
* (1) to add your changes to git's system
```
git add .
```
* (2) to commit your changes to the repo with a message
```
git commit -m "message about commit"
```
* (3) send changes to server (able to be pulled by others)
```
git push origin branch-name
```

###### Hint: Before pushing your code, it is best to pull the latest changes from Master. This will help reduce merge conflicts
ex:
```
git pull origin master
git add .
git commit -m "commit message"
git push origin branch-name
```


