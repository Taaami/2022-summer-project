FROM s1riu5/lamp:7.2
COPY project.sql /docker-entrypoint-initdb.d/
COPY src/ /var/www/html/demo
RUN chmod -R 777 /var/www/html