LycPHP
======

LycPHP是一个基于组件的PHP开源框架，组件之间无耦合关系，能完全独立使用到项目中。

### 目录结构：

	./Lyc		框架
	
		/Db							Db组件
		/Ftp						Ftp组件
		/Loader						自动加载组件
		/Log						日志组件
		/Mail						邮件组件
		/Mongo						MongoDB组件
		/Paginator					分页组件
		/Route						Route组件
		/Url						Url组件
	
	
	./Test		组件测试
	
		/LycTest.class.php				测试框架
		/DbTest.class.php				数据库测试
		/FtpTest.class.php				Ftp测试
		/LoaderTest.class.php			自动加载测试
		/LogTest.class.php				日志测试
		/MailTest.class.php				邮件测试
		/MongoTest.class.php			MongoDB测试
		/PaginatorTest.class.php		分页测试
		/UrlTest.class.php				Url测试
		/messages.sql					数据库测试DB库
		/RouteTest					Route测试	  


### 引入组件：

	推荐方法：自动引入组件
		<?php
			use Lyc\Loader\Autoloader;
			define('PDIR','请输入目录');
			require_once PDIR.'/Lyc/Loader/Autoloader.class.php';
			Autoloader::getInstance();
		?>
	具体案例：请看./Test目录下的任一组件的测试类

		
### 开发环境：

	 Centos 6.6 +mysql 5.0+nginx 1.0.5 +php 5.4.0
	 框架中使用命名空间而且此功能是php5.3加入的，
	 所以建议使用php 5.4.0以上


### BUG反馈：

	通过本平台反馈以外，也可以通过博客留言：
	http://www.apoyl.com/?page_id=9
	请提供具体的平台，php版本及错误代码
	
		  		    
