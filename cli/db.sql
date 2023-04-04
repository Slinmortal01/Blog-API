CREATE DATABASE IF NOT EXISTS Blog;
USE Blog;

CREATE TABLE IF NOT EXISTS posts
(
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    content text NOT NULL,
    thumbnail text,
    author varchar(255),
    posted_at date
    );

CREATE TABLE IF NOT EXISTS categories
(
    id VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description text
    );

CREATE TABLE IF NOT EXISTS posts_categories
(
    id_post VARCHAR(255),
    id_category VARCHAR(255)
    );