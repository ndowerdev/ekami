# EKAMI

EKAMI AGC - PHP Based Automated Content Generator


## Convert keywords to database
```bash
# 1. Convert keywords to database
php index.php import start

# 2. Start Scraping
php index.php googlebase scrape
```


## Exporting data

You can export data as:
```bash
# Blogspot
php index.php export start blogspot

# Wordpress
php index.php export start wordpress


# HTML Static
php index.php export start html

# All (Blogspot+ Wordpress + HTML Static)
php index.php export start
```


## Cleaning Data

```bash
# Clear All Data
php index.php googlebase delete_data

# Clear export data
php index.php export delete_export

```
