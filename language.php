<?php
/*
 * URL: Apexteam.ir
 * Auth: Morteza Bagheri
 * Team: Apexteam
 */

class language
{
    private $language_code, $json;

    /**
     * language constructor.
     * @param $language_code (a short name of language in the folder languages)
     */
    public function __construct($language_code)
    {
        if (!is_dir("languages")) {
            mkdir("languages");
        }
        if (!is_file('languages/' . $language_code . ".json")) {
            file_put_contents("languages/$language_code.json", json_encode([
                "app_name" => "Language Maker",
                "welcome_text" => "Welcome to my app",
                "hello_world" => "Hello dear world",
                "from" => "apexteam.ir",
                "maker" => "t.me/shitilestan"
            ], JSON_PRETTY_PRINT));
        }
        $this->json = json_decode(file_get_contents("languages/$language_code.json"), true);
        $this->language_code = $language_code;
    }

    /**
     * @param $key
     * @return string
     */
    function getValue($key)
    {
        if (isset($this->json[$key])) {
            return $this->json[$key];
        } else {
            return "Value not found";
        }
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    function setValue($key, $value)
    {
        if (!isset($this->json[$key])) {
            $this->json[$key] = $value;
            file_put_contents("languages/" . $this->language_code . ".json", json_encode($this->json, JSON_PRETTY_PRINT));
            return true;
        } else {
            return false;
        }
    }
}
