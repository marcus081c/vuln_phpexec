# vuln_phpexec

A SSRF vulnerable php file with javascript and html content. It allows you to execute a ping command on the server with a specified IP address
and returns the output to the client browser.

It uses the XMLHttpRequest javascript object to communicate with the server side php script and the php stdout is inserted on the html code through a javascript function.
