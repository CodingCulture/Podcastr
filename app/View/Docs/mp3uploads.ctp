<div class="well">
    This method is only as backup. This is not neccesary, because your server supports HTTP uploads.
</div>


<h3 id="setup"><?php echo __('Setting up your account');?></h3>
<p><?php echo __('Uploads to Gamehour are dependant of the server config. This installation only supports SFTP. This means you will have a user account on the webservers operating system. First off, lets change the default password');?></p>
<p><?php echo __('Open up your terminal client (Terminal on OSX, and if you are on Windows please download CygWin). There you will type the command <code>ssh USERNAME@gamehour.be</code>. It will prompt for a password. Supply the password that you\'ve received from your system administrator.');?></p>
<p><?php echo __('You\'ll now be logged in into a Linux enviroment. Don\'t worry, you won\'t be here for long. Type the command <code>passwd</code>. The system will now ask for your current password, a new password and a confirmation of that password. Please choose a safe, strong password.');?></p>
<p><?php echo __('You now have a safe user that can upload to the upload directory. To close the session and logout from the enviroment, just type <code>exit</code>');?></p>

<h3 id="upload"><?php echo __('Uploading new files');?></h3>
<p><?php echo __('First off, open your SFTP client like Filezilla. There you will need to login with your credentials. Hostname is <code>gamehour.be</code> and port is <code>22</code>');?></p>
<p><?php echo __('Once logged in, you\'ll need to navigate to <code>/var/www/html/app/webroot/files/podcasts</code> on the Remote Site (the right pane). Then choose the file you want to upload from the Local Site (the left pane) and just drag and drop to the Remote Site.');?></p>

<h3 id="add"><?php echo __('Adding files to podcasts');?></h3>
<p><?php echo __('When you have uploaded a file, remember its filename, and append it to the Podcast Mp3 string already in place. For example, if your filename is <code>Episode3.mp3</code>, the text inside the Podcast Mp3-field should be <code>/files/podcasts/Episode3.mp3</code>');?></p>
<p><?php echo __('Once logged in, you\'ll need to navigate to <code>/var/www/html/app/webroot/files/podcasts</code> on the Remote Site (the right pane). Then choose the file you want to upload from the Local Site (the left pane) and just drag and drop to the Remote Site.');?></p>
