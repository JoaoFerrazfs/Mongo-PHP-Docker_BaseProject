FROM php:8.1-apache

# Instala dependências
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libcurl4-openssl-dev pkg-config libssl-dev \
    libzip-dev unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Copia o Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Copia o projeto para a imagem Docker
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Define permissões para o diretório
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Cria um novo arquivo de configuração do Apache
RUN echo "<VirtualHost *:80>" > /etc/apache2/sites-available/000-default.conf && \
    echo "    DocumentRoot /var/www/html/public" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    <Directory /var/www/html/public>" >> /etc/apache2/sites-available/000-default.conf && \
    echo "        Options Indexes FollowSymLinks" >> /etc/apache2/sites-available/000-default.conf && \
    echo "        AllowOverride All" >> /etc/apache2/sites-available/000-default.conf && \
    echo "        Require all granted" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    </Directory>" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    DirectoryIndex index.php" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    ServerName localhost" >> /etc/apache2/sites-available/000-default.conf && \
    echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf

# Habilita mod_rewrite
RUN a2enmod rewrite

# Habilita o site
RUN a2ensite 000-default.conf
