<pre>
<strong>Hostname:</strong>
<?php system("hostname"); ?>
<br />
<strong>Uptime:</strong>
<?php system("uptime"); ?>
<br />
<strong>System Information:</strong>
<?php system("uname -a"); ?>
<br />
<strong>Memory Usage (GB):</strong>
<?php system("free -g"); ?>
<br />
<strong>CPU units:</strong>
<?php system("nproc --all"); ?>
<br />
<strong>Device list :</strong>
<?php system("lspci"); ?>
<br />
</pre>
