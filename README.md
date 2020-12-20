# Chris Hofer Wordpress
## by Lena Ebner  and Simon Sölder

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

* Use WP CLI to manage your wordpress site starting with wp core download --locale=de_DE in the public folder.
* Keep only one pre-installed theme (2020), delete the rest.
* Use WP's menu feature for the main navigation and the footer navigation.
* Create three pages (incl. the frontpage) with proper contents, the rest of the pages can be blank.
* Create and integrate favicons (and other metafiles) with the real Favicon Generator
* Remember to host fonts locally.
* Must validate.

Must use: 
* categories
* Advanced Custom Fields
* timber

Must NOT
* use photos/graphics whose rights you don't own.

## Development

### Running with docker
Uses standard wp install and the public/wp-content folder
```bash
docker-compose up
```

## Timeline

Screendesign: due December, 21st - already approved
Deployed to server: due January, 22nd - in progress
