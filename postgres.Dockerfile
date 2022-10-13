FROM postgres:latest

COPY ./PostgreSQL/initDB/init.sql /docker-entrypoint-initdb.d/
