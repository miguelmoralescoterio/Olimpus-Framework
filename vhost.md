# CERTIFICADO CON OpenSSL
```
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout certs/keys/mamco-key.key -out certs/keys/mamco-cert.crt  -subj "/C=VE/ST=Zulia/L=San Francisco/O=Olimpus Soft & Data, C. A./OU=Desarrollo de Software/CN=mamco.com"
```
# Configuracion del VirtualHost
```
<VirtualHost *:80>
    ServerAdmin webmaster@mysite.com
    DocumentRoot ""
    ServerName mysite.com
    ServerAlias www.mysite.com mail.mysite.com
    ServerSignature Off
    DirectoryIndex index.php
    UseCanonicalName Off

    LogLevel error
    ErrorLog "logs/mysyte.com-error.log"
    CustomLog "logs/mysyte.com-access.log" common
    TransferLog "logs/mysyte.com-transfer.log"

    <Directory "">
        Options -Indexes +FollowSymLinks -MultiViews
        Order Allow,Deny
        Allow from all
        AllowOverride All
        Require all granted
        SSILegacyExprParser On
        
        RewriteEngine On

        RewriteCond %{HTTPS} off
        RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
        RewriteOptions inherit

    </Directory>
</VirtualHost>

<IfModule ssl_module>
    <VirtualHost *:443>
        ServerAdmin webmaster@mysite.com
        DocumentRoot ""
        ServerName mysite.com
        ServerAlias www.mysite.com mail.mysite.com
        ServerSignature Off
        DirectoryIndex index.php
        UseCanonicalName Off

        LogLevel error
        ErrorLog "logs/mysyte.com-error-ssl.log"
        CustomLog "logs/mysyte.com-access-ssl.log" common
        TransferLog "logs/mysyte.com-transfer-ssl.log"

        SSLEngine On
        SSLCipherSuite ALL:!ADH:!EXPORT56:RC4+RSA:+HIGH:+MEDIUM:+LOW:+SSLv2:+EXP:+eNUL
        SSLCertificateFile "keys/mysite-cert.crt"
        SSLCertificateKeyFile "keys/mysite-key.key"
        SSLOptions +FakeBasicAuth +ExportCertData +StrictRequire
        
        <FilesMatch "\.(cgi|shtml|pl|asp|php)$">
            SSLOptions +StdEnvVars
        </FilesMatch>

        <Directory "/cgi-bin">
            SSLOptions +StdEnvVars
        </Directory>

        <Directory "">
            Options -Indexes +FollowSymLinks -MultiViews
            AllowOverride All
            Order Allow,Deny
            Allow from all
            Require all granted
            SSILegacyExprParser On

            RewriteEngine On

            RewriteCond %{HTTPS} off
            RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
            RewriteOptions inherit

            # Handle Authorization Header
            RewriteCond %{HTTP:Authorization} .
            RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

            # Redirect Trailing Slashes If Not A Folder...
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_URI} (.+)/$
            RewriteRule ^ %1 [L,R=301]

            # Handle Front Controller...
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^ index.php [L]


            Header set Cache-Control "no-cache, no-store, must-revalidate"
            Header set Pragma "no-cache"
            Header set Expires 0
            Header set Access-Control-Allow-Origin *
       
    
            BrowserMatch ".*MSIE.*" nokeepalive ssl-unclean-shutdown downgrade-1.0 force-response-1.0

            <IfModule mod_setenvif.c>

                # Mozilla prior to 4.0
                BrowserMatchNoCase ^Mozilla/[0-3] legacy=mozilla

                # malignant Mozilla versions
                BrowserMatchNoCase ^.?mozilla(?:$|/(?:(?:[^45]|[45]\.(?:[^0]|0\S))|(?:(?:[45]\.0\s\(compatible;?\)|5\.0(?:\s\((?:en(?:-US)?)?\))?)$))) legacy=mozilla

                # MSIE prior to 7.0
                BrowserMatchNoCase MSIE\D+[0-6]\.[\d.]* legacy=msie
                

                # Firefox prior to 4.0
                BrowserMatchNoCase Firefox\D+[0-3]\.[\d.]* legacy=firefox

                # Chrome prior to 9.0
                BrowserMatchNoCase Chrome\D+[0-9]\.[\d.]* legacy=chrome

                # Safari (inc Mobile) prior to 534
                BrowserMatchNoCase Safari\D+(?:[0-4]+|\d?53[0-3]\.[\d.]*) legacy=safari

                # Opera prior to 9.80
                BrowserMatchNoCase Opera\D+(?:[0-8][\d.]*|9\.[0-7]) legacy=opera

                # Seamonkey prior to 2.6
                BrowserMatchNoCase SeaMonkey\D+(?:[01]|2\.[0-5]) legacy=seamonkey

                Deny from env=legacy
            </IfModule>
         </Directory>
    </VirtualHost>
</IfModule>
```