<?php

/*

REQUIREMENTS

* A custom slash commant on a Slack team
* A web server running PHP5 with cURL enabled

USAGE

* Place this script on a server running PHP5 with cURL.
* Set up a new custom slash command on your Slack team: 
  http://my.slack.com/services/new/slash-commands
* Under "Choose a command", enter whatever you want for 
  the command. /isitup is easy to remember.
* Under "URL", enter the URL for the script on your server.
* Leave "Method" set to "Post".
* Decide whether you want this command to show in the 
  autocomplete list for slash commands.
* If you do, enter a short description and usage hing.

*/


# Grab some of the values from the slash command, create vars for post back to Slack
$command = $_POST['command'];
$text = $_POST['text'];
$token = $_POST['token'];

// # Check the token and make sure the request is from our team 
// if($token != 'UmTIV5TPPljOVTrBcFgzoS8V'){ #replace this with the token from your slash command configuration page
//   $msg = "The token for the slash command doesn't match. Check your script.";
//   die($msg);
//   echo $msg;
// }


# isitup.org doesn't require you to use API keys, but they do require that any automated script send in a user agent string.
# You can keep this one, or update it to something that makes more sense for you
$user_agent = "Dice Roll for Slack/1.0 (potentato@gmail.com)";

# We're just taking the text exactly as it's typed by the user. If it's not a valid request, rolz.org will respond with an error.
# We want to get the JSON version back (you can also get plain text).
$url_to_check = "https://rolz.org/api/?".$text.".json";

# Set up cURL 
$ch = curl_init($url_to_check);

# Set up options for cURL 
# We want to get the value back from our query 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
# Send in our user agent string 
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

# Make the call and get the response 
$ch_response = curl_exec($ch);
# Close the connection 
curl_close($ch);

# Decode the JSON array sent back by rolz.org
$response_array = json_decode($ch_response,true);

# Build our response 
# Note that we're using the text equivalent for an emoji at the start of each of the responses.
# You can use any emoji that is available to your Slack team, including the custom ones.
if($ch_response === FALSE){
  # isitup.org could not be reached 
  $reply = "Ironically, diceroll could not be reached.";
}else{
  $reply = "You rolled: ".$response_array["result"]." ".$response_array["details"];
}

# Send the reply back to the user. 
echo $reply;
