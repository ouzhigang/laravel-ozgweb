###部署步骤

	1.需要根据实际情况设置laravel-ozgweb/config/app.php的url部分，默认已设好


    2.需要根据实际情况设置laravel-ozgweb/vue/mgr/src/components/common/common.js，默认已设好

	
	3.执行composer update


    4.把.env.example改成.env


    5.执行php artisan key:generate


    6.执行php bin/laravels start


    7.cd到laravel-ozgweb/vue/mgr，执行npm i && npm run build
	
	
	8.设置nginx目录laravel-ozgweb/public，然后在server节加入如下配置
    
	#静态文件用到
    location ~ .*\.(css|js|jpg|jpeg|gif|png|mp3|apk|zip|txt|eot|html)$ {
        expires 24h;
        root /usr/share/nginx/html;
    }

    location /mgr/ {
        expires 24h;
        root /usr/share/nginx/html;
    }

    location / {
        #运行swoole的ip
        proxy_pass http://172.17.0.2:8101/;
        #下边是为获取真实IP所做的设置
        proxy_set_header    X-Real-IP        $remote_addr;
        proxy_set_header    X-Forwarded-For  $proxy_add_x_forwarded_for;
        proxy_set_header    HTTP_X_FORWARDED_FOR $remote_addr;
        proxy_set_header    X-Forwarded-Proto $scheme;
        proxy_redirect      default;
    }
	
	
	
==========

前台入口：/

后台入口：/mgr/


后台用户密码都是admin。
