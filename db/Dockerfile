FROM mysql:latest

ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_USER=std
ENV MYSQL_DATABASE=student
ENV MYSQL_PASSWORD=password
ENV MYSQL_ALLOW_EMPTY_PASSWORD=1

COPY ./std_table.sql /docker-entrypoint-initdb.d/
