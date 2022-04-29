<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2021 seffeng
 */
namespace Seffeng\LaravelRules\Rules;

use Illuminate\Contracts\Validation\Rule;
use Seffeng\Rules\IDNumber as IDNumberRule;

/**
 * 身份证号验证[仅支持18位]
 * @author zxf
 * @date   2021年07月01日
 * @method static bool getIsStrict()
 * @method static string getLocation()
 * @method static string getBirthday()
 * @method static string getGender()
 * @method static string getGenderName()
 * @method static \DateInterval getYears()
 */
class IDNumber implements Rule
{
    /**
     *
     * @var string
     */
    protected $regex;

    /**
     * 是否检测地区（前6位）
     * @var boolean
     */
    protected $isStrict = true;

    /**
     *
     * @var IDNumberRule
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
        $this->validator = (new IDNumberRule($this->regex));
        $this->getValidator()->setIsStrict($this->isStrict);
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
     * @return IDNumberRule
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
