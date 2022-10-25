<img src="https://atomjump.com/images/logo80.png">

# livewiki
AtomJump Messaging Server Plugin to create a live wiki using a wordcloud.


## Requirements

For your Messaging Server:
* AtomJump Messaging Server >= 0.5.0

Or

* AtomJump Messaging >= 0.5.1 and AtomJump.com API (Use: https://clst[n].atomjump.com/api/ as the Messaging Server where [n] = 0,1 or 2)

For your livewiki:
* PHP >= 5.3
* npm
* bower ([optional] for local js/css files)


## Installation notes:

This plugin should be put on the client website (not in the AtomJump Loop server plugins directory), and it is best as a front-end to a full install of AtomJump Messaging Server https://src.atomjump.com/atomjump/loop-server. 

After installing the messaging server, from your intended livewiki home directory:

1. `git clone https://src.atomjump.com/atomjump/livewiki.git .`

2. `cd livewiki`
        
3. `npm install wordcloud`

4. [Optional] `bower install atomjump`

5. `cp configORIGINAL.php config.php`

Now edit the options in config.php. If you included your own bower install, include the local relative paths.

6. `chmod 777 data/words.json`


## Using the Live Wiki

You can add and remove any number of forums quickly at the bottom. Then start typing in each forum and communicating with your fellow
team members.


## Demo

A demo is available at http://atomjump.org/demo/livewiki/
