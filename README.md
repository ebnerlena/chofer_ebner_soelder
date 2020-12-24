# Chris Hofer Wordpress

## by Lena Ebner and Simon Sölder

Chris is a great singer focussing on popular music. Chris is located in Salzburg and has won several prizes.  
Chris is a playful, trendy person who easily finds an audience.

## What is the website for?

Chris has four main goals:

- being booked for gigs like Christmas parties
- finding a band
- offering singing lessons
- and generally becoming more famous.

Chris also wants to share news (Chris has just won another competition!) and give some background info (like vita and personal stuff).  
There are no favourite colors, but the typo should be powerful and artistic, and the site needs biiig hero images and maybe some cool effects, oooh yeah!

## Technical requirements

All sites need to be implemented in WordPress.
(If you are bored with WordPress because you are a WordPress pro, please talk to me. We could probably find a CMS that's new to you.)
The 'Alex Meyer'-site is the model, concerning technical standards and scope (+ timber).
As a reminder, here are the most important requirements:

- Use WP CLI to manage your wordpress site starting with wp core download --locale=de_DE in the public folder.
- Keep only one pre-installed theme (2020), delete the rest.
- Use WP's menu feature for the main navigation and the footer navigation.
- Create three pages (incl. the frontpage) with proper contents, the rest of the pages can be blank.
- Create and integrate favicons (and other metafiles) with the real Favicon Generator
- Remember to host fonts locally.
- Must validate.

Must use:

- categories
- Advanced Custom Fields
- timber

Must NOT

- use photos/graphics whose rights you don't own.

## Development

### Running with docker

Uses standard wp install and the public/wp-content folder

```bash
docker-compose up
```

Importing sql dump into local db container:

```bash
# Get id of db container
docker ps

# import dump
docker exec -i <id> mysql -u<user> -p<password> <dbname> < dump.sql
# example:
docker exec -i 5d60ff3143dd mysql -uwp -p12345678 wp < chris_dump.sql

# UPDATE URL REFERENCES
# connect to mysql shell
docker exec -it <id> -u<user> -p<password>
```

Update URL References:

```bash
# connect to mysql shell
docker exec -it <id> mysql -u<user> -p<password>
```

```sql
UPDATE wp_options SET option_value = replace(option_value, 'https://chris.vm-aqua.soelder.net', 'http://localhost:8080') WHERE option_name = 'home' OR option_name = 'siteurl';

UPDATE wp_posts SET guid = replace(guid, 'https://chris.vm-aqua.soelder.net','http://localhost:8080');

UPDATE wp_posts SET post_content = replace(post_content, 'https://chris.vm-aqua.soelder.net','http://localhost:8080');

UPDATE wp_postmeta SET meta_value = replace(meta_value, 'https://chris.vm-qua.soelder.net','http://localhost:8080');
```

### SQL dump e.g. from server to local

1. Make a db dump: `sudo mysqldump --add-drop-table --no-tablespaces wp_chris > ./chris_dump.sql`
2. Copy dump to local setup: `scp -P 5412 admin@193.170.119.171:/home/admin/chris_dump.sql ./`
3. Restore dump: `mysql -u root -p chofer < chris_dump.sql`
4. Update url references:
   - `UPDATE wp_options SET option_value = replace(option_value, 'https://chris.vm-aqua.soelder.net', 'http://chofer.localhost') WHERE option_name = 'home' OR option_name = 'siteurl';`
   - `UPDATE wp_posts SET guid = replace(guid, 'https://chris.vm-aqua.soelder.net','http://chofer.localhost');`
   - `UPDATE wp_posts SET post_content = replace(post_content, 'https://chris.vm-aqua.soelder.net','http://chofer.localhost');`
   - `UPDATE wp_postmeta SET meta_value = replace(meta_value, 'https://chris.vm-qua.soelder.net','http://chofer.localhost');`

## Timeline

Screendesign: due December, 21st - already approved
Deployed to server: due January, 22nd - in progress
