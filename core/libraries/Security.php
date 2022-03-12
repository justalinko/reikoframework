<?php

/**
 * REIKO FRAMEWORK 
 *  
 * @package ReiKo Framework
 *
 * @author alinko <alinkokomansuby@gmail.com>
 * @author ReiYan <hariyantoriyan.hr@gmail.com>
 * @copyright (c) 2021 
 * 
 * @license MIT 
 * 
 */

namespace Reiko\Libraries;


class Security
{
    public static $errors;

    public static function reiko_password($string)
    {
        return 'RKY' . strtoupper(sha1(md5($string)));
    }
    public static function generate_token()
    {
        return hash('sha256', base64_encode($_SERVER['REMOTE_ADDR'] . date('dmYHis') . $_SERVER['HTTP_USER_AGENT']));
    }

    public static function csrf_token()
    {
        return hash($_ENV['CSRF_HASH_ALGO'], date('dmYH'));
    }
    public static function csrf_validate($csrf)
    {
        if ($csrf == self::csrf_token()) {
            return true;
        } else {
            return false;
        }
    }
    public static function validate_password($password)
    {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        } else {
            return true;
        }
    }
    public static function validate_email($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        } else {
            return true;
        }
    }

    public static function make_validation($data = [])
    {
        self::$errors = [];
        $failed = 0;
        foreach ($data as $req => $rule) {
            $filter = self::$rule($req);
            if ($filter !== true) {
                $failed++;
                self::$errors[$rule] = $filter;
            }
        }

        if ($failed > 0) {
            return self::$errors;
        } else {
            return true;
        }
    }
}
