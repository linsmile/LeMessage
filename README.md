
## Installation

#### 使用 Composer 安装

- 在项目中的 `composer.json` 文件中添加 jpush 依赖：

```json
"require": {
    "lepush/lemessage": "*"
}
```

- 执行 `$ php composer.phar install` 或 `$ composer install` 进行安装。

#### 直接下载源码安装

- 下载源代码包，解压到项目中
- 在项目中引入 autoload：

```php
require 'path_to_sdk/autoload.php';
```

test