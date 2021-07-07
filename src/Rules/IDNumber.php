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
 */
class IDNumber implements Rule
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
        return (new IDNumberRule($this->regex))->passes($value);
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
