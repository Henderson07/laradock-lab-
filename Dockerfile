ARG TZ=America/Sao_Paulo

FROM ubuntu:20.04

# Configure timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone

# Update packages and install dependencies
RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y software-properties-common \
    tzdata \
    unzip \
    sudo \
    vim \
    curl

# Add the PHP 8.0 repository and install PHP and dependencies
RUN apt-get update && apt-get install -y \
    software-properties-common \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y \
    php8.0 \
    php8.0-cli \
    php8.0-dev \
    php8.0-xml \
    php8.0-curl \
    php8.0-bcmath \
    php8.0-gd \
    php8.0-mbstring \
    php8.0-mysql \
    php8.0-xsl \
    php8.0-zip \
    php8.0-pdo-mysql \
    apache2 \
    apache2-utils \
    libapache2-mod-php8.0 \
    sudo \
    vim \
    curl \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php8.0 -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project
COPY . /var/www/html

# Configure Apache
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data

# Install Apache and dependencies
RUN apt-get install -y \
    apache2 \
    apache2-utils \
    libapache2-mod-php8.0 \
  && a2dismod mpm_event \
  && a2enmod mpm_prefork \
  && a2enmod php8.0 \
  && a2enmod xml2enc \
  && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
  && a2enmod rewrite \
  && a2dissite 000-default

# Copy the Apache configuration file
COPY crud.conf /etc/apache2/sites-available/crud.conf
RUN ln -s /etc/apache2/sites-available/crud.conf /etc/apache2/sites-enabled/crud.conf \
    && a2ensite crud.conf

# Set PHP as the default PHP binary
RUN update-alternatives --set php /usr/bin/php8.0

# Set the owner of the document root to www-data
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install Laravel dependencies
RUN composer install --no-interaction --prefer-dist

# Clear Laravel cache
RUN php artisan config:clear && php artisan cache:clear

# Restart Apache
RUN service apache2 restart

# Clean up
RUN apt-get clean

# Expose the HTTP port
EXPOSE 80

# Start Apache in the foreground
CMD ["/usr/sbin/apache2ctl", "-DFOREGROUND"]
