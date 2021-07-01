<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2021 seffeng
 */
namespace Seffeng\LaravelRules\Rules;

use Illuminate\Contracts\Validation\Rule;

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
    protected $regex = '/^\d{17}[0-9x]$/i';

    /**
     * 对应位置的加权因子
     * @var array
     */
    protected $wi = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];

    /**
     * 对应的校验码
     * @var array
     */
    protected $y = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];

    /**
     *
     * @var integer
     */
    protected $mod = 11;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $regex = null)
    {
        if (!is_null($regex)) {
            $this->regex = $regex;
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (preg_match($this->regex, $value) === 1) {
            return $this->compareIDNumber($value);
        }
        return false;
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
     * @date   2021年7月1日
     * @param string $value
     * @return string
     */
    protected function calculateY(string $value)
    {
        $s = 0;
        for ($i = 0; $i < 17; $i++) {
            $s += intval($value[$i]) * $this->wi[$i];
        }
        $mod = $s % $this->mod;
        return isset($this->y[$mod]) ? $this->y[$mod] : '';
    }

    /**
     *
     * @author zxf
     * @date   2021年7月1日
     * @param string $value
     * @return boolean
     */
    protected function compareIDNumber(string $value)
    {
        return $value === (substr($value, 0, 17) . $this->calculateY($value));
    }
}
