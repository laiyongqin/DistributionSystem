# DistributionSystem
分销系统
1. 安装说明文档
2. 项目环境
 1. 使用环境：PHP 7.0+ mysql5.5 +Nginx Linux
 2. 使用框架：Yaf2.0
 3. 表结构：编辑器打开sql既可
 4. 步骤一：安装环境
 5. 步骤二：
1.安装完成后进入 修改php.ini文件 尾部添加以下代码
>[yaf]
  yaf.library = extension=php_yaf.dll
2. 进入php/ext文件夹添加php_yaf.dll文件
PS：修改配置文件添加yaf框架拓展 载入library类库  路径请根据实际情况修改
3. 集成环境默认安装mysql phpmyadmin

步骤三：
1. oss为后台源码 www为前台源码
2. 进入对应文件夹中的config\application.ini文件
修改数据库对应地址 账号 密码
3. 修改配置
1. Application.host主机名，修改为当前域名
2. application.image_url，图片路径，修改为当前域名

3. 支付接口
> \library\Pay\Weixin\WxPay.Config.php配置相关参数 证书4个  调用2个
4. 4.微信公众后台 对应配置都要修改


~~~
此项目开发与2016年5月
~~~
