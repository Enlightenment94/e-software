<style>
textarea{
	width: 100%;
	border: none;
	scroll-y: none;
	min-height: 60px;
	overflow: auto;
	margin: 5px;	
	resize: both;
}
</style>
<h1>Standard .htaccess rulez</h1>

<div>
	<textarea readonly><Files "blocked">
  Order Allow,Deny
  Deny from all
</Files></textarea></br>
	<a href='./blocked'>./blocked</a>
</div>

<div>
	<textarea readonly style='height:220px;'><FilesMatch ".+\.(type|bin|js)$">
  Order Allow,Deny
  Deny from All
</FilesMatch>

<Files "\.(type|bin)$">
  Order Allow,Deny
  Deny from all
</Files>

<Files "*.cos">
  Order Allow,Deny
  Deny from all
</Files>
</textarea></br>
	<a href='./block.js'>./block.js</a></br>
	<a href='./block.type'>./block.type</a></br>
	<a href='./block.bin'>./block.bin</a>
</div>

<div>
	<textarea readonly><Files "allow.type">
  Order Allow,Deny
  Allow from all
</Files></textarea></br>
	<a href='./allow.type'>./allow.type</a>
</div>

<div>
	<pre>RewriteRule ^htaccessTest/blockDir/(.+?)(-[0-9]+)?$ - [F,L]</pre>
	<a href='./blockDir'>./blockDir</a></br>
	<a href='./blockDir/block'>./blockDir/block</a></br>
	<a href='./blockDir/gdgfdg'>./blockDir/gdgfdg</a>
</div>

<div>
	<pre>RewriteRule ^htaccessTest/redirectDir/$ http://www.google.com [R]
RewriteRule ^htaccessTest/redirectDir/(.+?)(-[0-9]+)?$ http://www.google.com [R]</pre>
	<a href='./redirectDir/'>./redirectDir</a></br>
	<a href='./redirectDir/'>./redirectDir/</a></br>
	<a href='./redirectDir/redirect'>./redirectDir/redirect</a></br>
	<a href='./redirectDir/fdfgfdfhfd'>./redirectDir/fdfgfdfhfd</a>
</div>

<div>
	<pre>Allow file in blocked dir of path must be top above deny rule
RewriteRule ^htaccessTest/blockDir/allow$ - [L]</pre>
	<a href='./blockDir/allow'>./blockDir/allow</a>
</div>

<div>
	<pre>#Block indexes files
#Options -Indexes 

#Prevent display of select file types
#IndexIgnore *.wmv *.mp4 *.avi *.etc

#Set default index page
#DirectoryIndex business.html

#Block signature
#ServerSignature Off</pre>
</div>


<pre>Źródła:
	1. https://perishablepress.com/stupid-htaccess-tricks/
	2. www.stackoverflow.com
	3. https://httpd.apache.org/docs/current/mod/core.html#filesmatch
</pre>
