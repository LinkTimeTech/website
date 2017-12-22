<?php

require_once dirname(__FILE__) . '/res/OmiseApiResource.php';

class OmiseOccurrence extends OmiseApiResource
{
    const ENDPOINT = 'occurrences';

    /**
     * Retrieves an occurence object.
     *
     * @param  string $id
     * @param  string $publickey
     * @param  string $secretkey
     *
     * @return OmiseOccurrence
     */
    public static function retrieve($id, $publickey = null, $secretkey = null)
    {
        return parent::g_retrieve(get_class(), self::getUrl($id), $publickey, $secretkey);
    }

    /**
     * @param  string $id
     *
     * @return string
     */
    private static function getUrl($id = '')
    {
        return OMISE_API_URL . self::ENDPOINT . '/' . $id;
    }

    public function reload()
    {
        parent::g_reload(self::getUrl($this['id']));
    }
}