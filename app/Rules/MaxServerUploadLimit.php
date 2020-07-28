<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxServerUploadLimit implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $limit = (int) ini_get('upload_max_filesize') * 1024 * 1024;
        return $value->getSize() < $limit;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Max size of upload file ' . ini_get('upload_max_filesize');
    }
}
