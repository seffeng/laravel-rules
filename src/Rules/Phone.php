<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2020 seffeng
 */
namespace Seffeng\LaravelRules\Rules;

use Illuminate\Contracts\Validation\Rule;
use Seffeng\Rules\Phone as PhoneRule;

/**
 * 手机号验证
 * @author zxf
 * @date    2020年05月21日
 */
class Phone implements Rule
{
    /**
     *
     * @var string
     */
    protected $regex;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (new PhoneRule($this->regex))->passes($value);
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
}
