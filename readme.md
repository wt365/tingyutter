# Tingyutter 

Tingyutter is an experimental project of a twitter-like microblog system written in PHP.

### Site Structrue

- **index.php** - home page
- **settings.php** - all Settings
- **add-tweet.php** - adding new tweet page
- **functions.php** - Functions needed
- **readme.md** - this page
- **[asset]** - resources folder
- **[bio]** - user avatar folder
- **[img]** - tweeted images folder

### Database Table Structure

table structure (keys):

- **id** - tweet id, *main key*
- **uid** - tweet author's user id
- **tweet** - tweet text
- **time** - date-time of a tweet
- **pic** - path of image (if any) in a tweet
