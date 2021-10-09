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
     * 是否检测地区（前6位）
     * @var boolean
     */
    protected $isStrict = true;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rule = (new IDNumberRule($this->regex));
        $rule->setIsStrict($this->isStrict);
        return $rule->passes($value);
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
