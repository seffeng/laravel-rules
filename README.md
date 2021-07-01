## Laravel Rules

### 安装

```shell
# 安装
$ composer require seffeng/laravel-rules
```

### 目录说明

```
├─src
│  └─Rules                  验证规则
│       Password.php            密码
│       Phone.php               手机号
```

### 示例

```php
/**
 * TestRequest.php
 * 表单验证示例
 */
namespace App\Http\Requests;

use Seffeng\LaravelRules\Rules\Password;
use Seffeng\LaravelRules\Rules\Phone;

class TestRequest
{
    protected $fillable = ['phone', 'password'];

    public function rules()
    {
        return [
            'phone' => [
                'required',
                new Phone()
            ],
            'password' => [
                'required',
                new Password()
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute不能为空！'
        ];
    }

    public function attributes()
    {
        return [
            'phone' => '手机号',
            'password' => '密码',
        ];
    }
}
```

### 备注

无

### 更新日志

[CHANGELOG](CHANGELOG.md)

