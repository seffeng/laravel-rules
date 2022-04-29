### 更新日志

* 2022-04-29

  * 增加密码验证等级，参考 [rules](https://github.com/seffeng/php-rules/blob/HEAD/CHANGELOG.md)
  
* 2021-07-01

  * 增加身份证号码验证规则

    ```php
    /**
     * TestRequest.php
     * 表单验证示例
     */
    namespace App\Http\Requests;
    
    use Seffeng\LaravelRules\Rules\IDNumber;
    
    class TestRequest
    {
        protected $fillable = ['identify'];
    
        public function rules()
        {
            return [
                'identify' => [
                    'required',
                    new IDNumber()
                ],
            ];
        }
    
        public function attributes()
        {
            return [
                'identify' => '身份证号码',
            ];
        }
    }
    ```
  
    ```php
    use Seffeng\LaravelRules\Rules\IDNumber;
    
    /**
     * Test.php
     * 方法验证示例
     */
    public function test()
    {
        $rule = new IDNumber();
        $value = '123456789123456789';
        var_dump($rule->passes('', $value));exit;
    }
    ```
  

---

