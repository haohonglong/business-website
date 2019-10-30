后台   **用户名:admin 密码123456**
mysql  ./data/fangjun-10-26.sql

 * Nginx
 ```bash
 server {
     set $www /www;
     server_name fangju.local;
     root   $www/fangju/frontend/web/;
     index  index.php index.html index.htm;
     try_files $uri $uri/ /index.php?$args;
 
 
     location ~ \.php$ {
         fastcgi_pass   127.0.0.1:9000;
         fastcgi_index  index.php;
         fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
         include        fastcgi_params;
         try_files $uri =404;
     }
 
     location ~* .(ico|gif|bmp|jpg|jpeg|png|swf|js|css|mp3) {
         expires 3d;
     }
 
     error_page   500 502 503 504  /50x.html;
     location = /50x.html {
         root   html;
     }
 }
 server {
     set $www /www;
     server_name fangju.admin;
     root   $www/fangju/backend/web/;
     index  index.php index.html index.htm;
     try_files $uri $uri/ /index.php?$args;
 
 
     location ~ \.php$ {
         fastcgi_pass   127.0.0.1:9000;
         fastcgi_index  index.php;
         fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
         include        fastcgi_params;
         try_files $uri =404;
     }
 
     location ~* .(ico|gif|bmp|jpg|jpeg|png|swf|js|css|mp3) {
         expires 3d;
     }
 
     error_page   500 502 503 504  /50x.html;
     location = /50x.html {
         root   html;
     }
 }

 ```
 
