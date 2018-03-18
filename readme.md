**Just another BEST APP**

To setup you need only installed docker on your machine

**SETUP:**
1. first run docker container

        docker-compose up -d
        
2. than you have to install dependencies, you can let composer to do that
        
        docker-compose exec php comopser install
                
Cool, that's it, now you have working instance of the BEST APP. Congratilation.


To use this app you have to call some of following commands:
        
to download post call:

        docker-compose exec php php index.php post <ID> [comment]
to download user        
 
        docker-compose exec php php index.php user <ID> [post]
        

**All output files are stored in "data" folder.**
        
*NOTE: < ID > parameter is required*