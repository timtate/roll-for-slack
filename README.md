# roll-for-slack

Custom slash command to use rolz.org to make random dice rolls

## REQUIREMENTS

* A custom slash command on a Slack team
* A web server running PHP5 with cURL enabled

## USAGE

* Place the `diceroll.php` script on a server running PHP5 with cURL.
* Set up a new custom slash command on your Slack team: http://my.slack.com/services/new/slash-commands
* Under "Choose a command", enter whatever you want for the command. /roll is easy to remember.
* Under "URL", enter the URL for the script on your server.
* Leave "Method" set to "Post".
* Decide whether you want this command to show in the autocomplete list for slash commands.
* If you do, enter a short description and usage hint.
* Update the `diceroll.php` script with your slash command's token, if you want to use a token. (code is commented out here)

## REFERENCE 

You can download the script this is derived from and read a tutorial for writing your own at https://github.com/mccreath/isitup-for-slack/
