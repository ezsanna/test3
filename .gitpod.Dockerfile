FROM gitpod/workspace-full

USER root

# Install Apache, PHP and MySQL server
RUN sudo apt-get update && \
    sudo apt-get install -y apache2 php libapache2-mod-php php-mysqli mariadb-server && \
    sudo apt-get clean

# Enable Apache mod_rewrite
RUN sudo a2enmod rewrite

# Setup Apache document root to /workspace (default working dir)
RUN sudo sed -i 's|DocumentRoot /var/www/html|DocumentRoot /workspace|' /etc/apache2/sites-available/000-default.conf

# Allow .htaccess overrides
RUN sudo sed -i '/<Directory \/workspace>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Expose port 8080 (Gitpod default for web preview)
EXPOSE 8080

# Change Apache to listen on port 8080
RUN sudo sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sudo sed -i 's/:80/:8080/' /etc/apache2/sites-available/000-default.conf

# Initialize MariaDB (MySQL) and set root password as empty
RUN sudo service mysql start && \
    mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY ''; FLUSH PRIVILEGES;"

# Start services on container start
CMD sudo service mysql start && sudo service apache2 start && bash

USER gitpod
