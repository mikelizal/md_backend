install: 	
	unzip Meteor.zip
	cp -rf Meteor /usr/bin
	echo '00 10   * * *   root 	cd /usr/bin/Meteor && java -cp "/usr/bin/Meteor/json.jar:/usr/bin/Meteor/Main.jar" /usr/bin/Meteor/Main' >> /etc/crontab
	cd
	echo "Instalación completada."
