<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WordCount implements Rule
{
    protected $maxWords;

    public function __construct($maxWords = 300)
    {
        $this->maxWords = $maxWords;
    }

    public function passes($attribute, $value)
    {
        $wordCount = str_word_count(strip_tags($value)); // Count words, stripping HTML tags
        return $wordCount <= $this->maxWords; // Validate against max words
    }

    public function message()
    {
        return 'The :attribute may not exceed ' . $this->maxWords . ' words.';
    }
}
