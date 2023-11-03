<pre>
Wordpress secuirty

+ 1. .htaccess block files.
	
+ 2. In php.ini disable dangerous functions.
	exec
	shell_exec
	...

3. Scannery, bp, logger.
	+ new files
	+ size
	- edit (prawie to samo co size bez 1 przypadku)
	+ niebezpiecznych funkcji, without default
	- niebezpiecznych funkcji, without default
	+ new wrong functions include ... 
	- wrong name 
	+ wtyczki
	 + listowanie
	 - usuwanie
	 - pobieranie
	+ privelagess scan
	   + 0755 for dir
	   + 0644 for files
	- ls_wp_content 
	
4. Manipulate paths: (Hide my wp)
	folders
	perifx_db
	login
	...

5. List plugins save, remove and download fresh plugins. Don't losse plugins list.

6. Clean Uploads and add .htaccess.

7. Clean themes.

8. Install WAF plugins and scaner -> malcare and check effect clean.

9. Scan in security Vendors.

</pre>

<h1>Cleaning</h1>

<div>
	+ <a href="./bp.php">bp</a>
</div>

<pre>
//refresh 
	wp-include, 
	wp-admin, 
	main -> not erase wp-conifg.php
//wp-content
	remove not useful directory
	list plugins, download plugins, refresh
	remove not useful themes, clean used theme
	clean uploads by find vectors in ssh or handwork
</pre>

<div>
	+ <a href="./vendors.php">vendors</a>
</div>

<div>
	- <a href="./viewer.php">viewer.php</a>
</div>

<div>
	+ <a href="./scanDangFunc.php">scanDangFunc.php</a>
</div>

<div>
	- <a href="./scanDangDefault.php">scanDangDefault.php</a>
</div>

<div>
	- <a href="./scanDangWithoutDefault.php">scanDangWithoutDefault.php</a>
</div>

<div>
	- <a href="./scanPlugins.php">scanPlugins.php</a>
</div>

<div>
	+ Clean other folders by ssh often virus copy to other places than web directory.
</div>

<h2>Securing</h2>

<div>
	+ <a href="./scanChange.php">scanChange.php</a>
</div>

<div>
	+ <a href="./scanPossible.php">scanPossible.php</a>
</div>

<div>
	+ <a href="./scanPrivelages.php">scanPrivelages.php</a>
</div>

<div>
	+ <a href="./htaccess.php">htaccess.php</a>
</div>

<div>
	+ <a href="./waf.php">WAF</a>
</div>

<div>
	- <a href="./sync.php">sync</a>
<div>