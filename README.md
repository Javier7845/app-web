Clone the repository inside the home folder.

sudo git clone https://github.com/Javier7845/app-web

Inside the folder that was created open the terminal and run the following command:

sudo docker-compose up -d
 
We will now have 3 containers with all 3 services running. 

sudo docker ps

Finally, we open the browser to test the web application using docker.

http://your_ip:8080/ and http://your_ip:8000/
