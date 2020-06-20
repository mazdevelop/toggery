<?php
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$pdo = pdo();
$pdo->exec(" 
DO $$ DECLARE
    r RECORD;
BEGIN
    -- if the schema you operate on is not \"current\", you will want to
    -- replace current_schema() in query with 'schematodeletetablesfrom'
    -- *and* update the generate 'DROP...' accordingly.
    FOR r IN (SELECT tablename FROM pg_tables WHERE schemaname = current_schema()) LOOP
        EXECUTE 'DROP TABLE IF EXISTS ' || quote_ident(r.tablename) || ' CASCADE';
    END LOOP;
END $$;
");
$pdo->exec('CREATE TABLE admins(
    id SERIAL PRIMARY KEY,
    name TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
    )');
$pdo->exec('CREATE TABLE categories(
    id SERIAL PRIMARY KEY,
    slug TEXT UNIQUE NOT NULL,
    name TEXT NOT NULL
    )');
$pdo->exec("INSERT INTO categories (slug,name) VALUES ('health-books','Health books')");
$pdo->exec("INSERT INTO categories (slug,name) VALUES ('sleeping-bags','Sleeping Bags')");
$pdo->exec('CREATE TABLE products(
    id SERIAL PRIMARY KEY,
    category_id INTEGER NOT NULL REFERENCES categories ,
    name TEXT NOT NULL,
    description TEXT NOT NULL
)');
