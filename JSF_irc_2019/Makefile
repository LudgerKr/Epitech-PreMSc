install:
	cd client && npm install
	cd serveur && npm install

dev: 
	make -j 2 run_client run_server

run_server:
	     cd serveur && nodemon server.js
run_client:
	     cd client && ng serve

