<img src="https://atomjump.com/images/logo80.png">

# livewiki
AtomJump Loop Server Plugin to create a live wiki using a wordcloud.


## Requirements

For your Loop Server:
* AtomJump Loop Server >= 0.5.0

Or

* AtomJump Loop >= 0.5.1 and AtomJump.com API (Use: https://atomjump.com/api/)

For your livewiki:
* PHP >= 5.3
* npm
* bower


## Installation notes:

This plugin should be put on the client website (not in the AtomJump Loop server plugins directory), and it is best as a front-end to a full install of AtomJump Loop Server https://github.com/atomjump/loop-server. 

After installing the loop-server, from your intended livewiki home directory:

1. `git clone https://github.com/atomjump/livewiki.git .`
        
2. `npm install wordcloud`

3. `bower install atomjump`

4. `cp configORIGINAL.php config.php`

Now edit the options in config.php. 

5. `chmod 777 data/words.json`


## Using the Live Wiki

You can add and remove any number of forums quickly at the bottom. Then start typing in each forum and communicating with your fellow
team members.


## Demo

A demo is available at https://atomjump.com/demo/livewiki/
