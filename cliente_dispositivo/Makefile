install: 	
	cp Meteor.zip /usr/bin
	cd /usr/bin
	unzip Meteor.zip
	rm Meteor.zip
	echo '00 10   * * *   root 	cd usr/bin && java -cp "./json.jar:./Main.jar" Main' >> /etc/crontab
	cd
	echo "Instalación completada."
