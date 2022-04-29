<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2020 seffeng
 */
namespace Seffeng\LaravelRules\Rules;

use Illuminate\Contracts\Validation\Rule;
use Seffeng\Rules\Password as PasswordRule;

/**
 * 密码验证
 * @author zxf
 * @date    2020年05月21日
 * @method  static PasswordRule setNumber(int $number = null)
 * @method  static integer getNumber()
 * @method  static PasswordRule setLevel(int $level = null)
 * @method  static integer getIsLevel()
 * @method  static boolean getIsLevelII()
 * @method  static boolean getIsLevelIII()
 * @method  static boolean getIsLevelIV()
 */
class Password implements Rule
{
    /**
     *
     * @var string
     */
    protected $regex;

    /**
     *
     * @var integer
     */
    protected $level;

    /**
     *
     * @var integer
     */
    protected $number;

    /**
     *
     * @var PasswordRule
     */
    protected $validator;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->validator = new PasswordRule($this->regex);
        $this->getValidator()->setLevel($this->level);
        $this->getValidator()->setNumber($this->number);
        return $this->getValidator()->passes($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute格式错误！';
    }

    /**
     *
     * @author zxf
     * @date   2022年4月29日
     * @return PasswordRule
     */
    protected function getValidator()
    {
        return $this->validator;
    }

    /**
     *
     * @author zxf
     * @date   2022年4月29日
     * @param  string $method
     * @param  mixed $parameters
     * @throws \Exception
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->getValidator(), $method)) {
            return $this->getValidator()->{$method}(...$parameters);
        } else {
            throw new \Exception('方法｛' . $method . '｝不存在！');
        }
    }
}
